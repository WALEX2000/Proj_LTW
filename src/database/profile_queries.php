<?php

include_once('../database/connection.php');

function get_user_info($username)
{
    global $db;
        $stmt = $db->prepare('select * from User where username = ?');
        $stmt->execute(array($username));
        $user_info = $stmt->fetch(); 
    return $user_info;
}

function insertUser($user_info) {
    global $db;
    $options = ['cost' => 12];
    $stmt = $db->prepare('INSERT INTO User VALUES(?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($user_info['username'], $user_info['name'], $user_info['email'], NULL, $user_info['birthday'], $user_info['nationality'], password_hash($user_info['password'], PASSWORD_DEFAULT, $options)));
  }

  function check_user_password($username, $password){
    global $db;
    $stmt = $db->prepare('select password from User where username = ?');
    $stmt->execute(array($username));
    $stored_password = $stmt->fetch();
    return $stored_password!== false && password_verify($password,$stored_password['password']);
  }

?>