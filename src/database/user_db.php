<?php
include_once('../database/connection.php');

function getAllUsers(){
  global $db;
  $stmt = $db->prepare('SELECT * FROM User');
  $stmt->execute();
  return $stmt->fetchAll();
}

function getUser($username) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch();
  }

  
  ?>