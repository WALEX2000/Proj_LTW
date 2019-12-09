<?php
include_once('../database/connection.php');

function insert_comment($story_id, $username, $content, $current_date, $rating){ 
    global $db;
    $stmt = $db->prepare('INSERT INTO Comment VALUES(?, ?, ?, ?, ?, ?)');
    $stmt->execute(array(null,$username, $story_id, $current_date, $content, $rating));
}

function insert_reply($username, $content, $current_date, $comment){ 
    global $db;
    $stmt = $db->prepare('INSERT INTO Reply VALUES(?, ?, ?, ?, ?)');
    $stmt->execute(array(null,$comment, $username, $current_date, $content));
}

function get_all_comments($story_id){
    global $db;
    $stmt = $db->prepare('select * from Comment where story = ? order by date(comment_date) desc, id desc');
    $stmt->execute(array($story_id));
    $comments = $stmt->fetchAll();
    return $comments;
}

function get_reply($comment_id){
    global $db;
    $stmt = $db->prepare('select * from Reply where comment = ?');
    $stmt->execute(array($comment_id));
    $reply = $stmt->fetch();
    return $reply;
}
?>