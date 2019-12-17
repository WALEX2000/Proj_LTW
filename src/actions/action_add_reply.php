<?php

include_once('../database/connection.php');
include_once('../database/comment_queries.php');
include_once('../includes/session.php');
include_once('../database/image_queries.php');
include_once('../database/profile_queries.php');

if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

$username = $_SESSION['username'];
$content = dust_off($_POST['reply_content']);
$current_date = date("Y-m-d");
$comment =dust_off( $_POST['comment']);
$story_id = $_SESSION['story_id'];

try {
    insert_reply($username, $content, $current_date, $comment);
    $user_pic = get_image_url(get_user_info($username)['profile_image']);
    $name = get_user_info($username)['name'];
    $enchoded = array('name' => $name, 'pic' => $user_pic, 'reply_date' => $current_date, 'reply_content' => $content);
    echo json_encode($enchoded);
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to send reply!');
    die(header("Location: ../pages/home.php"));
  }

?>