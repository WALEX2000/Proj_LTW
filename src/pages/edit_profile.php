<?php

include_once('../includes/session.php');
include_once('../database/profile_queries.php');
include_once('../templates/tpl_common.php');
include_once('../templates/tpl_authentication.php');


draw_header("index.css");
$username =$_SESSION['username'];
$user_info = get_user_info($username);
draw_edit_profile_form($user_info);
draw_footer();
?>
