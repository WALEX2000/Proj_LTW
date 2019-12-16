<?php
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_authentication.php');

    draw_header("index.css", ['topBar.js']);
    draw_register();
    draw_footer();
?>
