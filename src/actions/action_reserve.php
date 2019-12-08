<?php
    include_once('../database/connection.php');
    include_once('../database/stories_queries.php');
    include_once('../includes/session.php');

    $start_date = $_POST['start_date'];
    $end_date =  $_POST['end_date'];
    $num_guests=  $_POST['num_guests'];
    $story_id = $_SESSION['story_id'];


    if ($start_date > $end_date){
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'The start date should be before the end date!');
      die(header("Location: ../pages/story.php?story_id=$story_id"));
    }
    
    $already_existing_res = get_rented_stories_by_dates($story_id, $start_date, $end_date);
    if (count($already_existing_res) != 0){
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Those dates are already occupied!');
      die(header("Location: ../pages/story.php?story_id=$story_id"));
    }

  try {
    $story =get_story_info($story_id);
    $total_price = $num_guests * $story['price_per_night'];
    $reservation_info = array('username' => $_SESSION['username'], 'story_id' =>$story_id, 'start_date' =>$start_date, 'end_date' =>$end_date, 'num_guests' =>$num_guests, 'total_price' =>$total_price);
    insert_reservation($reservation_info);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Reservation finished with success!');
    header('Location: ../pages/home.php');
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to make reservation!');
    header("Location: ../pages/story.php?story_id=$story_id");
  }
  ?>
