<?php

function get_story_info($story_id)
{
    global $db;
    $stmt = $db->prepare('select * from Story where id = ?');
    $stmt->execute(array($story_id));
    $story_info = $stmt->fetch();

    return $story_info;
}

function get_user_rented($username)
{
    global $db;

    $stmt = $db->prepare('Select * from Rented JOIN Story where Rented.renter = ? and Rented.story = Story.id');
    $stmt->execute(array($username));
    $rented_by_user = $stmt->fetchAll();
    return $rented_by_user;
}
