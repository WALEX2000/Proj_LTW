<?php

include_once('../includes/session.php');
include_once('../database/profile_queries.php');
include_once('../templates/tpl_common.php');
include_once('../templates/tpl_authentication.php');

$_SESSION['last_page'] = "edit_profile.php";

if (!isset($_SESSION['username']))
    die(header('Location: login.php'));

draw_header("index.css", ['topBar.js']);
$username =$_SESSION['username'];
$user_info = get_user_info($username);
draw_edit_profile_form($user_info);
draw_footer();
?>
