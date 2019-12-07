<?php

function get_story_info($story_id)
{
    global $db;
    $stmt = $db->prepare('select * from Story where id = ?');
    $stmt->execute(array($story_id));
    $story_info = $stmt->fetch();

    return $story_info;
}

function get_all_stories()
{
    global $db;
    $stmt = $db->prepare('select * from Story');
    $stmt->execute();
    $stories = $stmt->fetchAll();

    return $stories;
}

function get_rented_stories_by_dates($story_id, $start_date, $end_date)
{
    global $db;
    $stmt = $db->prepare('select R.id from Story S, Rented R where R.story = S.id and S.id = ? and (date(stay_start) < date(?) and date(stay_end) > date(?))');
    $stmt->execute(array($story_id, $end_date, $start_date));
    $story_rents = $stmt->fetchAll();

    return $story_rents;
}

function get_user_rented($username)
{
    global $db;

    $stmt = $db->prepare('Select * from Rented JOIN Story where Rented.renter = ? and Rented.story = Story.id');
    $stmt->execute(array($username));
    $rented_by_user = $stmt->fetchAll();
    return $rented_by_user;
}

function get_user_renting($username)
{
    global $db;

    $stmt = $db->prepare('Select * from Story where owner = ?');
    $stmt->execute(array($username));
    $renting_by_user = $stmt->fetchAll();
    return $renting_by_user;
}

function insert_story($story_info, $username) {
    global $db;
    $stmt = $db->prepare('INSERT INTO Story VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array(null, $story_info['name'], $story_info['country'], $story_info['city'], $story_info['address'],NULL, $story_info['details'], 0, $username, date("Y/m/d"), $story_info['price_night'], $story_info['capacity']));
  }

function insert_reservation ($reservation_info){
    global $db;
    $stmt = $db->prepare('INSERT INTO Rented VALUES(?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array(null, $reservation_info['username'], $reservation_info['story_id'], $reservation_info['start_date'], $reservation_info['end_date'],$reservation_info['num_guests'], $reservation_info['total_price']));
}

function is_available($story_id, $check_in,$check_out){
    if($check_in == null or $check_out == null){
        return true;
    }
    global $db;
    $stmt = $db->prepare('select Story.id from Story join Rented where Rented.story = ? and date(stay_start) < date(?) and date(stay_end) > date(?)');
    $stmt->execute(array($story_id,$check_in,$check_out));
    $result = $stmt->fetch();
    return ($result == null);
}

function check_price_range($story_id, $price_min, $price_max){
    global $db;
    $stmt = $db->prepare('select Story.id from Story where Story.id = ? and Story.price_per_night >= ? and Story.price_per_night <= ?');
    $stmt->execute(array($story_id,$price_min, $price_max));
    $result = $stmt->fetchAll();
    if(count($result) > 0){
        return true;
    } 
    return false;
}

function check_capacity($story_id,$guests){
    if($guests == 1){
        return true;
    }
    global $db;
    $stmt = $db->prepare('select Story.id from Story where Story.id = ? and Story.capacity >= ?');
    $stmt->execute(array($story_id,$guests));
    $result = $stmt->fetchAll();
    if(count($result) > 0){
        return true;
    } 
    return false;
}

function check_location($story_id,$location){
    if($location == "null"){
        return true;
    }
    global $db;
    $stmt = $db->prepare('select Story.id from Story where Story.id = ? and (Story.country = ? or Story.city = ?)');
    $stmt->execute(array($story_id,$location, $location));
    $result = $stmt->fetch();
    return $result;
}

function get_available_stories($location, $check_in, $check_out, $price_min, $price_max, $number_of_guests){
    //check dates
    if($check_out == ""){
        print("Tou todo null");
    }
    global $db;
    $stmt = $db->prepare('select Story.id from Story where not exists (select * from Rented where Rented.story = Story.id and 
        (date(stay_start) < date(?) and date(stay_end) > date(?) 
        or ? = "" and date(?) >= date(stay_start) and date(?) < date(stay_end)
        or ? = "" and date(?) > date(stay_start) and date(?) <= date(stay_end)))
     and Story.price_per_night >= ? and Story.price_per_night <= ? 
     and Story.capacity >= ? 
     and (? = "" or Story.country = ? or Story.city = ?)');
    $stmt->execute(array($check_out, $check_in, $check_out, $check_in, $check_in, $check_in, $check_out, $check_out, $price_min, $price_max, $number_of_guests, $location,$location,$location));
    $available = $stmt->fetchAll();
     
    /*$all_stories = get_all_stories();
    $valid_stories = [];
    foreach($all_stories as $story){
        if(check_location($story['id'], $location)){
            //if(is_available($story['id'],$check_in, $check_out)){
                if(check_price_range($story['id'],$price_min,$price_max)){
                    if(check_capacity($story['id'],$number_of_guests)){
                        array_push($valid_stories,$story);
                    }
                }
            //}
        }
            
                
    }
    return $valid_stories;*/
    return $available;
}
?>