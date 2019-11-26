<?php
include_once('../database/connection.php');
include_once('../database/profile_queries.php');
include_once('../includes/session.php');

$username = $_POST['username'];
$name =  $_POST['name'];
$email=  $_POST['email'];
$birthday=  $_POST['birthday'];
$nationality=  $_POST['nationality'];
$password = $_POST['password'];

if ( !preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username can only contain letters and numbers!');
    die(header('Location: ../pages/register.php'));
  }

  if ( !preg_match ("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/", $email)) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid email format!');
   die(header('Location: ../pages/register.php'));
  }
  try {
    $user_info = array('username' => $username, 'name' =>$name, 'email' =>$email, 'birthday' =>$birthday, 'nationality' =>$nationality, 'password' =>$password);
    insertUser($user_info);
    $_SESSION['username'] = $username;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
    header('Location: ../pages/home.php');
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
    header('Location: ../pages/register.php');
  }

?>