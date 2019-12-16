<?php

include_once('../database/connection.php');
include_once('../database/comment_queries.php');
include_once('../includes/session.php');

if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));
    print("POST");
    print_r($_POST);
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
print("heh");
print_r($content);
print("heh");

try {
    insert_comment($story_id, $username, $content, $current_date, $rating);
    echo json_encode(['name' => $username, 'story_id' => $story_id]);
    $location = 'Location: ../pages/story.php?story_id=' . $story_id;
    header($location);
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add comment!');
    $location = 'Location: ../pages/story.php?story_id=' . $story_id;
    header($location);
  }


?>