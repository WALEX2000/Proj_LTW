<?php
    include_once('../includes/session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_authentication.php');

    if (isset($_SESSION['username']))
        die(header('Location: profile.php'));

    draw_header("index.css", ['topBar.js']);
    draw_login();
    draw_footer();

?>