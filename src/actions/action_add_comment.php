<?php

include_once('../database/connection.php');
include_once('../database/comment_queries.php');
include_once('../includes/session.php');

if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

$username = $_SESSION['username'];
$story_id = $_SESSION['story_id'];
$content = $_POST['comment'];
$current_date = date("Y-m-d");
  if(array_key_exists('rate', $_POST)){
    $rating = $_POST['rate'];
  }
  else{
    $rating = null;
  }
 

try {
    insert_comment($story_id, $username, $content, $current_date, $rating);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added story successfully!');
    $location = 'Location: ../pages/story.php?story_id=' . $story_id;
    header($location);
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add story!');
    $location = 'Location: ../pages/story.php?story_id=' . $story_id;
    header($location);
  }

?>