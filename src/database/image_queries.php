<?php
include_once('../database/connection.php');

function get_image_url($id)
{
    global $db;
    $stmt = $db->prepare('select * from Image where id = ?');
    $stmt->execute(array($id));
    $image_url = $stmt->fetch();
    return $image_url['url'];
}

function get_image_id($url)
{
    global $db;
    $stmt = $db->prepare('select id from Image where url = ?');
    $stmt->execute(array($url));
    $image_id = $stmt->fetch();
    return $image_id['id'];
}

 function get_all_url_images_of_story($story_id)
{
    global $db;
    $stmt = $db->prepare('select distinct Image.url from Image join Story where Image.story = ?');
    $stmt->execute(array($story_id));
    $images_url = $stmt->fetchAll();
    return $images_url;
}

function insert_image($fileName, $fileUrl, $story_id) {
    global $db;
    $stmt = $db->prepare('INSERT INTO Image VALUES(?, ?, ?, ?)');
    $stmt->execute(array(NULL, $fileName, $fileUrl, $story_id));
  }
