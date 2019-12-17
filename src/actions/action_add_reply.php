<?php

include_once('../database/connection.php');
include_once('../database/comment_queries.php');
include_once('../includes/session.php');

if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));


$username = $_SESSION['username'];
$content = dust_off($_POST['reply_content']);
$current_date = date("Y-m-d");
$comment =dust_off( $_POST['comment']);
$story_id = $_SESSION['story_id'];

try {
    insert_reply($username, $content, $current_date, $comment);
    die(header("Location: ../pages/story.php?story_id=$story_id"));
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to send reply!');
    die(header("Location: ../pages/story.php?story_id=$story_id"));
  }

?>