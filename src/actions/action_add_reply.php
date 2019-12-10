<?php

include_once('../database/connection.php');
include_once('../database/comment_queries.php');
include_once('../includes/session.php');

if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));


$username = $_SESSION['username'];
$content = $_POST['reply_content'];
$current_date = date("Y-m-d");
$comment = $_POST['comment'];

try {
    insert_reply($username, $content, $current_date, $comment);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added story successfully!');
    header('Location: ../pages/home.php');
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add story!');
    header('Location: ../pages/home.php');
  }

?>