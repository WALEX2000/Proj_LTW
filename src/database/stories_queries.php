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

function get_most_recent_stories()
{
  global $db;
  $stmt = $db->prepare('select * from Story order by date(post_date) desc, id desc limit 10');
  $stmt->execute();
  $stories = $stmt->fetchAll();
  return $stories;
}

function get_most_rented_stories()
{
  global $db;
  $stmt = $db->prepare('select * from Rented R, Story S where S.id = R.story group by S.id order by count(*) desc limit 10');
  $stmt->execute();
  $stories = $stmt->fetchAll();
  return $stories;
}

function get_top_stories()
{
  global $db;
  $stmt = $db->prepare('select * from Story order by sum_ratings/number_ratings desc limit 10');
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

  $stmt = $db->prepare('Select distinct * from Story S, Rented R where R.story = S.id and R.renter = ?');
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

function get_reservations_of_story($story_id)
{
  global $db;

  $stmt = $db->prepare('Select * from Story S, Rented R where R.story = ? and S.id = R.story order by date(R.stay_start) asc, date(R.stay_end) asc');
  $stmt->execute(array($story_id));
  $reservations = $stmt->fetchAll();
  return $reservations;
}

function insert_story($story_info, $username)
{
  global $db;
  $stmt = $db->prepare('Insert into Story values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
  $stmt->execute(array(null, $story_info['name'], $story_info['country'], $story_info['city'], $story_info['address'], $story_info['main_image'], $story_info['details'], 0, 0, $username, date("Y-m-d"), $story_info['price_night'], $story_info['capacity']));
}

function get_story_id()
{
  global $db;

  $stmt = $db->prepare('Select id from Story where id = (select max(id) from Story)');
  $stmt->execute(array());
  $story_id = $stmt->fetch();
  print("id". $story_id['id']);
  return $story_id['id'];
}

function insert_reservation($reservation_info)
{
  global $db;
  $stmt = $db->prepare('insert into Rented values(?, ?, ?, ?, ?, ?, ?)');
  $stmt->execute(array(null, $reservation_info['username'], $reservation_info['story_id'], $reservation_info['start_date'], $reservation_info['end_date'], $reservation_info['num_guests'], $reservation_info['total_price']));
}

function delete_reservation($rent_id)
{
  global $db;
  $stmt = $db->prepare('delete from Rented where id = ?');
  $stmt->execute(array($rent_id));
}

function has_reserved($story_id, $username)
{
  global $db;
  $stmt = $db->prepare('select * from Rented where story = ? and renter = ?');
  $stmt->execute(array($story_id, $username));
  $reservation = $stmt->fetch();
  return $reservation;
}

function update_story_info($story_data, $new_story_data)
{
  if ($new_story_data['name'] != NULL) {
    $name = $new_story_data['name'];
  } else {
    $name = $story_data['name'];
  }

  if ($new_story_data['country'] != NULL) {
    $country = $new_story_data['country'];
  } else {
    $country = $story_data['country'];
  }

  if ($new_story_data['city'] != NULL) {
    $city = $new_story_data['city'];
  } else {
    $city = $story_data['city'];
  }

  if ($new_story_data['address'] != NULL) {
    $address = $new_story_data['address'];
  } else {
    $address = $story_data['address'];
  }

  if ($new_story_data['details'] != NULL) {
    $details = $new_story_data['details'];
  } else {
    $details = $story_data['details'];
  }

  if ($new_story_data['price_per_night'] != NULL) {
    $price_per_night = $new_story_data['price_per_night'];
  } else {
    $price_per_night = $story_data['price_per_night'];
  }

  if ($new_story_data['capacity'] != NULL) {
    $capacity = $new_story_data['capacity'];
  } else {
    $capacity = $story_data['capacity'];
  }

  global $db;
  $stmt = $db->prepare('update Story set name = ?, country = ?, city = ?, address = ?, details = ?, price_per_night = ?, capacity = ? where id = ?');
  $stmt->execute(array($name, $country, $city, $address, $details, $price_per_night, $capacity, $new_story_data['story_id']));
}

function get_available_stories($location, $check_in, $check_out, $price_max, $number_of_guests)
{

  global $db;
  $stmt = $db->prepare('select Story.id from Story where not exists (select * from Rented where Rented.story = Story.id and 
        (date(stay_start) < date(?) and date(stay_end) > date(?) 
        or ? = "" and date(?) >= date(stay_start) and date(?) < date(stay_end)
        or ? = "" and date(?) > date(stay_start) and date(?) <= date(stay_end)))
      and Story.price_per_night <= ? 
      and Story.capacity >= ? 
      and (? = "" or Story.country = ? or Story.city = ?)');
  $stmt->execute(array($check_out, $check_in, $check_out, $check_in, $check_in, $check_in, $check_out, $check_out, $price_max, $number_of_guests, $location, $location, $location));
  $available = $stmt->fetchAll();

  return $available;
}
