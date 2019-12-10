<?php
    include_once('src/templates/tpl_common.php');
    include_once('src/templates/tpl_home_page.php');
    include_once('src/database/stories_queries.php');

    draw_header("index.css");
    $all_stories = get_all_stories();
    draw_home($all_stories);
    draw_footer();
?>