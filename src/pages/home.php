<?php
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_home_page.php');
    include_once('../database/stories_queries.php');

    $_SESSION['last_page'] = "home.php";

    draw_header("index.css", ['topBar.js', 'home.js']);
    $all_stories = get_all_stories();
    $top_story = get_top_stories();
    $most_rented = get_most_rented_stories();
    $most_recent_stories = get_most_recent_stories();
    draw_home($top_story,$most_recent_stories,$most_rented);
    draw_footer();
?>