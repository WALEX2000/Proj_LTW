<?php
include_once('../database/connection.php');
include_once('../database/profile_queries.php');
include_once('../database/image_queries.php');
include_once('../includes/session.php');

$username =dust_off( $_POST['username']);
$name = dust_off( $_POST['name']);
$email = dust_off( $_POST['email']);
$birthday = dust_off( $_POST['birthday']);
$nationality = dust_off( $_POST['nationality']);
$password =dust_off( $_POST['password']);

if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username can only contain letters and numbers!');
  die(header('Location: ../pages/register.php'));
}

if (!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/", $email)) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid email format!');
  die(header('Location: ../pages/register.php'));
}

if (empty($_FILES["profile_img"]["tmp_name"]) == true) { 
  $fileName = NULL;
} else {
  $file = $_FILES['profile_img'];
  print_r ($file);
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileError = $file['error'];
  $fileType = $file['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));
  print_r($fileActualExt);

  $allowed = array('jpg', 'jpeg', 'png');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 1000000) {
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = '../../images/' . $fileNameNew;

        if (!move_uploaded_file($fileTmpName, $fileDestination)) {
          $_SESSION['messages'][] = array('type' => 'error', 'content' => 'There was an error uploading your file!');
          header('Location: ../pages/register.php');
        }
      } else {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Your file is too big!');
        header('Location: ../pages/register.php');
      }
    } else {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'There was an error uploading your file!');
      header('Location: ../pages/register.php');
    }
  } else {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'You cannot upload files of this type!');
    header('Location: ../pages/register.php');
  }
}

try {
  if ($fileName !== NULL){
    insert_image($fileName, $fileNameNew, NULL);
    $image_id = get_image_id($fileNameNew);
  }else{
    $image_id = 1;
  }
  
  $user_info = array('username' => $username, 'name' => $name, 'email' => $email, 'birthday' => $birthday, 'nationality' => $nationality, 'password' => $password, 'image' => $image_id);
  insert_user($user_info);
  $_SESSION['username'] = $username;
  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
  $go_to = "Refresh:0;url=../pages/" . $_SESSION['last_page'];
  header($go_to);
} catch (PDOException $e) {
  die($e->getMessage());
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
  header('Location: ../pages/register.php');
}
