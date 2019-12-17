<?php
  include_once('../includes/session.php');
  include_once('../database/stories_queries.php');
  include_once('../database/connection.php');

  if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

  if ($_SESSION['csrf'] !== $_POST['csrf']) {
    $go_to = "Refresh:0;url=../pages/" . $_SESSION['last_page'];
    die(header($go_to));
  }


$story_id = $_SESSION['story_id'];
$name =  dust_off($_POST['name']);
$country=  dust_off($_POST['country']);
$city=  dust_off($_POST['city']);
$address=  dust_off($_POST['address']);
$details = dust_off($_POST['details']);
$price_per_night = dust_off($_POST['price_per_night']);
$capacity = dust_off($_POST['capacity']);

if (!preg_match("/^([0-9]*[.])?[0-9]+$/", $price_per_night)) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Price can only contain numbers and a dot!');
  $go_to = "Refresh:0;url=../pages/" . $_SESSION['last_page'];
  die(header($go_to));
}


try {
  $new_story_info = array('story_id' => $story_id,'name' =>$name, 'country' =>$country, 'city' =>$city, 'address' =>$address, 'details' =>$details, 'price_per_night' =>$price_per_night, 'capacity' =>$capacity);
  $old_story_info = get_story_info($story_id);
  update_story_info($old_story_info,$new_story_info);
  $_SESSION['story_id'] = $story_id;
  header("Location: ../pages/story.php?story_id=$story_id");
} catch (PDOException $e) {
  die($e->getMessage());
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to update place\'s information!');
  header('Location: ../pages/edit_story.php');
}

?>