<?php
    include_once('../includes/session.php');
    include_once('../templates/tpl_add_story.php');
    include_once('../templates/tpl_common.php');

    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    draw_header("index.css");
    draw_add_story_form();
    draw_footer();
?>