<?php
include_once('../database/connection.php');
include_once('../database/stories_queries.php');
include_once('../includes/session.php');


$location = $_POST['location'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$guests = $_POST['guests'];

//$price_min = $_POST['price_min'];
//$price_max = $_POST['price_max'];
//print_r("1");
print_r($check_out);
//print_r("2");
$results = get_available_stories($location, $check_in, $check_out, 0, 10000, $guests);
foreach($results as $result){
    print_r($result);
}
