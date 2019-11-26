<?php

include_once('../templates/tpl_common.php');
include_once('../templates/tpl_story_page.php');
include_once('../database/stories_queries.php');
include_once('../database/image_queries.php');


$story_id = $_GET['story_id'];
$story_info = get_story_info($story_id);
$all_story_images = get_all_url_images_of_story($story_id);
draw_header();
draw_story_info($story_info,$all_story_images);
draw_footer();
?>