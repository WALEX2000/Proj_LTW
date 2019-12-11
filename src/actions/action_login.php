<?php
include_once('../database/connection.php');
include_once('../database/profile_queries.php');
include_once('../includes/session.php');

$username = $_POST['username'];
$password = $_POST['password'];

if(check_user_password($username,$password)){
        $_SESSION['username'] = $username;
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged in!');
}
else{
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to login!');
}
$go_to = "Refresh:0;url=../pages/" . $_SESSION['last_page'];

header($go_to);

