<?php

include_once('src/database/connection.php');
include_once('src/database/image_queries.php');

function get_user_info($username)
{
  global $db;
  $stmt = $db->prepare('select * from User where username = ?');
  $stmt->execute(array($username));
  $user_info = $stmt->fetch();
  return $user_info;
}

function insert_user($user_info)
{
  global $db;
  $options = ['cost' => 12];
  $stmt = $db->prepare('INSERT INTO User VALUES(?, ?, ?, ?, ?, ?, ?)');
  $stmt->execute(array($user_info['username'], $user_info['name'], $user_info['email'], $user_info['image'], $user_info['birthday'], $user_info['nationality'], password_hash($user_info['password'], PASSWORD_DEFAULT, $options)));
}


function check_user_password($username, $password)
{
  global $db;
  $stmt = $db->prepare('select password from User where username = ?');
  $stmt->execute(array($username));
  $stored_password = $stmt->fetch();
  return $stored_password !== false && password_verify($password, $stored_password['password']);
}


function update_user_info($user_data, $new_user_data,$current_password)
{
  if ($new_user_data['name'] != NULL) {
    $name = $new_user_data['name'];
  } else {
    $name = $user_data['name'];
  }

  if ($new_user_data['email'] != NULL) {
    $email = $new_user_data['email'];
  } else {
    $email = $user_data['email'];
  }

  if ($new_user_data['birthday'] != NULL) {
    $birthday = $new_user_data['birthday'];
  } else {
    $birthday = $user_data['birthday'];
  }

  if ($new_user_data['nationality'] != NULL) {
    $nationality = $new_user_data['nationality'];
  } else {
    $nationality = $user_data['nationality'];
  }
  if ($new_user_data['password'] != NULL) {
    $password = $new_user_data['password'];
  }
  else{
    $password = $current_password;
  }

  global $db;
  $options = ['cost' => 12];
  $stmt = $db->prepare('update User set name = ?, email = ?, birthday = ?, nationality = ?, password = ? where username = ?');
  $stmt->execute(array( $name, $email, $birthday,$nationality, password_hash($password, PASSWORD_DEFAULT, $options),$user_data['username']));
  print_r($nationality);
}
