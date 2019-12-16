<?php

    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_story_page.php');
    include_once('../database/stories_queries.php');
    include_once('../database/image_queries.php');
    include_once('../includes/session.php');
    
    $_SESSION['last_page'] = "search_results.php";

    draw_header("searchResults.css");
    draw_search_results();
    draw_footer();
    
?>