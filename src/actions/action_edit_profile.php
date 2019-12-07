<?php
  include_once('../includes/session.php');
  include_once('../database/profile_queries.php');

$username = $_SESSION['username'];
$name =  $_POST['name'];
$email=  $_POST['email'];
$birthday=  $_POST['birthday'];
$nationality=  $_POST['nationality'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];

if(check_user_password($username,$current_password)){
  $new_user_info = array('username' => $username, 'name' =>$name, 'email' =>$email, 'birthday' =>$birthday, 'nationality' =>$nationality, 'password' =>$new_password);
  $old_user_info = get_user_info($username);
  update_user_info($old_user_info,$new_user_info,$current_password);
  $_SESSION['username'] = $username;
  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Access granted!');
  header('Location: ../pages/home.php');
}
else{
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to login!');
  header('Location: ../pages/login.php');
}

?>