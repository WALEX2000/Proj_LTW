<?php
  include_once('../includes/session.php');
  include_once('../database/profile_queries.php');
  include_once('../database/connection.php');

  if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
      $go_to = "Refresh:0;url=../pages/" . $_SESSION['last_page'];
      die(header($go_to));
    }

$username = $_SESSION['username'];
$name = dust_off( $_POST['name']);
$email= dust_off( $_POST['email']);
$birthday= dust_off( $_POST['birthday']);
$nationality= dust_off( $_POST['nationality']);
$current_password = dust_off($_POST['current_password']);
$new_password = dust_off($_POST['new_password']);

try{
  if(check_user_password($username,$current_password)){
    $new_user_info = array('username' => $username, 'name' =>$name, 'email' =>$email, 'birthday' =>$birthday, 'nationality' =>$nationality, 'password' =>$new_password);
    $old_user_info = get_user_info($username);
    update_user_info($old_user_info, $new_user_info, $current_password);
    $_SESSION['username'] = $username;
    header('Location: ../pages/home.php');
  }
  else{
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to update profile!');
    header('Location: ../pages/edit_profile.php');
  }
} catch (PDOException $e) {
  die($e->getMessage());
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to update profile!');
  header('Location: ../pages/edit_profile.php');
}

?>