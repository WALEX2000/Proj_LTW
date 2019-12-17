<?php

include_once('../database/connection.php');
include_once('../database/comment_queries.php');
include_once('../database/profile_queries.php');
include_once('../database/image_queries.php');
include_once('../includes/session.php');

if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

$username = $_SESSION['username'];
$story_id = $_SESSION['story_id'];
$content = dust_off($_POST['comment']);
$current_date = date("Y-m-d");
  if(array_key_exists('rate', $_POST)){
    $rating = dust_off( $_POST['rate']);
  }
  else{
    $rating = null;
  }
try {
    insert_comment($story_id, $username, $content, $current_date, $rating);
    $user_pic = get_image_url(get_user_info($username)['profile_image']);
    $enchoded = array('username' => $username, 'rate' => $rating, 'pic' => $user_pic, 'comment_date' => $current_date, 'comment_content' => $content);
    echo json_encode($enchoded);
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to send comment!');
    die(header("Location: ../pages/story.php?story_id=$story_id"));
  }
