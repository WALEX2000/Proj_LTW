<?php
    include_once('../database/connection.php');
    include_once('../database/stories_queries.php');
    include_once('../includes/session.php');

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

    $rent_id = $_SESSION['rent_id'];
    $username = $_SESSION['username'];

    try {
        delete_reservation($rent_id);
        $go_to = "Refresh:0;url=../pages/" . $_SESSION['last_page'];
        header($go_to);
    } catch (PDOException $e) {
        die($e->getMessage());
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to cancel reservation!');
        $go_to = "Refresh:0;url=../pages/" . $_SESSION['last_page'];
        header($go_to);
    }

?>