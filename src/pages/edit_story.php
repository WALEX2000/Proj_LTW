<?php

include_once('../includes/session.php');
include_once('../database/stories_queries.php');
include_once('../templates/tpl_common.php');
include_once('../templates/tpl_story_page.php');

if (!isset($_SESSION['username']))
    die(header('Location: login.php'));

draw_header("index.css");
$story_id =$_SESSION['story_id'];
$story_info = get_story_info($story_id);

if ($_SESSION['username'] != $story_info['owner']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'You\'re not the owner of this place!');
    die(header('Location: home.php'));
}

draw_edit_story_form($story_info);
draw_footer();
?>