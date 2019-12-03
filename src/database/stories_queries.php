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

function insertStory($story_info, $username) {
    global $db;
    $stmt = $db->prepare('INSERT INTO Story VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array(null, $story_info['name'], $story_info['country'], $story_info['city'], $story_info['address'],NULL, $story_info['details'], 0, $username, date("Y/m/d"), $story_info['price_night']));
  }

function insertReservation ($reservation_info){
    global $db;
    $stmt = $db->prepare('INSERT INTO Rented VALUES(?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array(null, $reservation_info['username'], $reservation_info['story_id'], $reservation_info['start_date'], $reservation_info['end_date'],$reservation_info['num_guests'], $reservation_info['total_price']));
}
?>