<?php
  include_once('../includes/session.php');
  include_once('../database/stories_queries.php');
  include_once('../database/connection.php');

$story_id = $_SESSION['story_id'];
$name =  $_POST['name'];
$country=  $_POST['country'];
$city=  $_POST['city'];
$address=  $_POST['address'];
$details = $_POST['details'];
$price_per_night = $_POST['price_per_night'];
$capacity = $_POST['capacity'];

try {
  $new_story_info = array('story_id' => $story_id,'name' =>$name, 'country' =>$country, 'city' =>$city, 'address' =>$address, 'details' =>$details, 'price_per_night' =>$price_per_night, 'capacity' =>$capacity);
  $old_story_info = get_story_info($story_id);
  update_story_info($old_story_info,$new_story_info);
  $_SESSION['story_id'] = $story_id;
  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Your place was updated with success');
  header('Location: ../pages/home.php');
} catch (PDOException $e) {
  die($e->getMessage());
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to update place\'s information!');
  header('Location: ../pages/edit_story.php');
}

?>