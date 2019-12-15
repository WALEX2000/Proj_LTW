<?php
include_once('../includes/session.php');
include_once('../templates/tpl_add_story.php');
include_once('../templates/tpl_common.php');
include_once('../templates/tpl_authentication.php');

$_SESSION['last_page'] = "add_story.php";

if (!isset($_SESSION['username'])) {
    die(header('Location: login.php'));
    draw_login();
?>
        <script>
            document.getElementById('login_modal').style.display = 'block'
        </script>
<?php
}

draw_header("addStory.css");
draw_add_story_form();
draw_footer();
?>