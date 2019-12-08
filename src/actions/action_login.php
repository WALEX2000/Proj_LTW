<?php
include_once('../database/connection.php');
include_once('../database/profile_queries.php');
include_once('../includes/session.php');

$username = $_POST['username'];
$password = $_POST['password'];

if (check_user_password($username, $password)) {
    $_SESSION['username'] = $username;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged in!');
    header('Location: ../pages/home.php');
} else {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to login!');
    header('Location: ../pages/login.php');
}
