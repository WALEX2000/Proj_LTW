<?php

include_once('../templates/tpl_common.php');
include_once('../templates/tpl_user_page.php');
include_once('../database/profile_queries.php');
include_once('../database/stories_queries.php');
include_once('../includes/session.php');

$_SESSION['last_page'] = "profile.php";

if (!isset($_SESSION['username']))
    die(header('Location: login.php'));

$user_given = $_SESSION['username'];
$user_info = get_user_info($user_given);
$profile_pic = get_image_url($user_info['profile_image']);
draw_header("profile.css");
?>
<div id="body">
<?php
draw_user_info($user_info,$profile_pic);

/* put button to choose one or another */
?>
<div id="housesPanel">
<?php
$rented_by_user = get_user_rented($user_info['username']);
draw_rented_stories($rented_by_user);
$renting_by_user = get_user_renting($user_info['username']);
draw_renting_stories($renting_by_user);
draw_edit_profile_form($user_info);
?>
</div>
<?php
draw_footer();
?>