<?php
    include_once('../database/connection.php');
    include_once('../database/stories_queries.php');
    include_once('../includes/session.php');

    $name = $_POST['title'];
    $country =  $_POST['country'];
    $city=  $_POST['city'];
    $address=  $_POST['address'];
    $details=  $_POST['details'];
    $price_night = $_POST['price_night'];

  try {
    $story_info = array('name' => $name, 'country' =>$country, 'city' =>$city, 'address' =>$address, 'details' =>$details, 'price_night' =>$price_night);
    $username = $_SESSION['username'];
    insertStory($story_info, $username);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added story successfully!');
    header('Location: ../pages/home.php');
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add story!');
    header('Location: ../pages/add_story.php');
  }

?>