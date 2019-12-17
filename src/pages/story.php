<?php

include_once('../templates/tpl_common.php');
include_once('../templates/tpl_story_page.php');
include_once('../database/stories_queries.php');
include_once('../database/comment_queries.php');
include_once('../database/image_queries.php');
include_once('../includes/session.php');

if (array_key_exists('story_id', $_GET)) {
    $story_id = $_GET['story_id'];
    $_SESSION['story_id'] = $story_id;
}
else if(array_key_exists('story_id', $$_SESSION)){
    $story_id = $_SESSION['story_id'];
}
else{
    header("Location: ../pages/home.php");
}
$_SESSION['last_page'] = "story.php";


$story_info = get_story_info($story_id);
$all_story_images = get_all_url_images_of_story($story_id);
$story_main_image = get_image_url($story_info['main_image']);
$reservations = get_reservations_of_story($story_id);
$comments = get_all_comments($story_id);
$owner = $story_info['owner'];
$capacity = $story_info['capacity'];

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $commented = has_commented($story_id, $username);
    $reserved = has_reserved($story_id, $username);
} else {
    $username = null;
    $commented = null;
    $reserved = null;
}

draw_header("story.css", ['topBar.js', 'house.js', 'comment.js', 'add_reply.js']);
?>
<div id="body">
    <div id="story_info">
        <?php
        draw_story_info($story_info, $all_story_images, $story_main_image, $username);
        draw_reserve_form($username, $owner, $story_info['capacity'], $story_info['price_per_night']);
        draw_reservations($username, $owner, $reservations);
        ?>
    </div>
</div>
<div id="allComments">
    <?php
        if ($username != null && $reserved != FALSE && $commented == FALSE) {
            draw_comment_form($username, $owner);
        }
        draw_all_comments($comments, $owner, $username);
    ?>
</div>
<?php
        draw_footer();
?>
</div>