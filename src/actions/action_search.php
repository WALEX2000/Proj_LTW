<?php
include_once('../database/connection.php');
include_once('../database/stories_queries.php');
include_once('../includes/session.php');

$location = $_POST['location'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$guests = $_POST['guests'];

if ( $check_in !== "" && $check_out !== "" && $check_in > $check_out){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'The check-in date should be before the check-out date!');
    die(header("Location: ../pages/home.php"));
  }

try {
    $results = get_available_stories($location, $check_in, $check_out, 0, 10000, $guests);
    foreach($results as $result){
        print_r($result);
    }
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Search done with success!');
    //TODO: Show results
    header('Location: ../pages/home.php');
}catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Search failed!');
    header("Location: ../pages/home.php");
}


