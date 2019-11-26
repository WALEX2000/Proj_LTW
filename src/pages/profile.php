<?php

include_once('../templates/tpl_common.php');
include_once('../templates/tpl_user_page.php');
include_once('../database/profile_queries.php');
include_once('../database/stories_queries.php');
include_once('../includes/session.php');

$user_given = $_SESSION['username'];
$user_info = get_user_info($user_given);
$profile_pic = get_image_url($user_info['profile_image']);
draw_header();
draw_user_info($user_info,$profile_pic);
$rented_by_user = get_user_rented($user_info['username']);
draw_rented_stories($rented_by_user);
draw_footer();
?>