<?php
include_once('../database/connection.php');

function get_image_url($name)
{
    global $db;
    $stmt = $db->prepare('select * from Image where name = ?');
    $stmt->execute(array($name));
    $image_url = $stmt->fetch();
    return $image_url['url'];
}

 function get_all_url_images_of_story($story_id)
{
    global $db;
    $stmt = $db->prepare('select distinct Image.url from Image join Story where Image.story = ?');
    $stmt->execute(array($story_id));
    $images_url = $stmt->fetchAll();
    return $images_url;
}

function insert_image($fileName, $fileUrl) {
    global $db;
    $stmt = $db->prepare('INSERT INTO Image VALUES(?, ?, ?, ?)');
    $stmt->execute(array(NULL, $fileName, $fileUrl, NULL));
  }

