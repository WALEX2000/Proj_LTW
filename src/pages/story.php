<?php

    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_story_page.php');
    include_once('../database/stories_queries.php');
    include_once('../database/comment_queries.php');
    include_once('../database/image_queries.php');
    include_once('../includes/session.php');

    $story_id = $_GET['story_id'];
    $_SESSION['story_id'] = $story_id;
    $story_info = get_story_info($story_id);
    $all_story_images = get_all_url_images_of_story($story_id);
    $comments = get_all_comments($story_id);
    $owner = $story_info['owner'];
    $capacity = $story_info['capacity'];

    if (isset($_SESSION['username']))
        $username = $_SESSION['username'];
    else{
        $username = null;
    }

    draw_header("index.css");
    draw_story_info($story_info, $all_story_images, $username);
    draw_reserve_form($username, $owner, $capacity);
    draw_comment_form($username,$owner);
    draw_all_comments($comments, $owner, $username);
    draw_footer();
