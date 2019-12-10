<?php
    include_once('../database/connection.php');
    include_once('../database/stories_queries.php');
    include_once('../includes/session.php');

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

    $rent_id = $_SESSION['rent_id'];
    $username = $_SESSION['username'];
    print_r($rent_id);

    try {
        delete_reservation($rent_id);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Canceled reservation successfully!');
        header('Location: ../pages/profile.php?username=username=$username');
    } catch (PDOException $e) {
        die($e->getMessage());
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to cancel reservation!');
        header("Location: ../pages/profile.php?username=username=$username");
    }

?>