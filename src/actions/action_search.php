<?php
include_once('../database/connection.php');
include_once('../database/stories_queries.php');
include_once('../includes/session.php');
include_once('../templates/tpl_story_page.php');


$location = $_POST['location'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$guests = $_POST['guests'];
$price_max = $_POST['budget'];

if ( $check_in !== "" && $check_out !== "" && $check_in > $check_out){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'The check-in date should be before the check-out date!');
    die(header("Location: ../pages/home.php"));
}

try {
    $results = get_available_stories($location, $check_in, $check_out, $price_max, $guests);
    if(count($results) > 0){
        $_SESSION['search_results'] = $results;
        header("Location: ../pages/search_results.php?");   
    }
    else{
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Search with no results!');
        $_SESSION['search_results'] = null;
        header("Location: ../pages/search_results.php?"); 
    }
}catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Search failed!');
    header("Location: ../pages/home.php");
}

?>
