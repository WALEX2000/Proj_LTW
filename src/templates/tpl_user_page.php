<?php
include_once('../database/image_queries.php');
include_once('../includes/session.php');

function draw_user_info($user_info, $image_url)
{
    ?>
    <div id="user_info">
        <img src="../../images/<?= $image_url ?>" alt="Photo of <?= $user_info['name'] ?>">
        <h1><?= $user_info['name'] ?></h1>
        <h3><?= $user_info['username'] ?></h3>
        <h2><?= $user_info['email'] ?></h2>
        <h2><?= $user_info['birthday'] ?></h2>
        <h2><?= $user_info['nationality'] ?></h2>
        <a href="edit_profile.php"><button id="editButton" type="submit" onclick=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
    </div>
<?php
}

function draw_rented_stories($rented)
{
    ?>
    <h1> Places you have rented </h1>
    <?php
        foreach ($rented as $story) {
            $image_url = get_image_url($story['main_image']);
            ?>
            <a href="story.php?story_id=<?= $story['story'] ?>">
                <img src="../../images/<?= $image_url ?>" alt="Photo of <?= $story['name'] ?> story">
                <h1><?= $story['name'] ?></h1>
                <h1><?= $story['stay_start'] ?></h1>
                <h1><?= $story['stay_end'] ?></h1>
            </a>
            <?php
            if ($story['stay_start'] >= date('Y-m-d', strtotime("+5 days"))){
                $_SESSION['rent_id'] = $story['id'];
                ?>
                <a href="../actions/action_cancel_reservation.php"><button id="cancelReservation" type="submit" onclick="">Cancel</button></a>
                <?php
            }else if ($story['stay_end'] < date('Y-m-d')){
                //if not rated
                ?>
                <h2> Rate! </h2>
                <?php
                //else
                //your rate is ...
            }
            ?>
            <br></br>
    <?php

        }
    }

    function draw_renting_stories($renting)
    {
        ?>
        <h1> Places you're renting </h1>
        <?php
        foreach ($renting as $story) {
            $image_url = get_image_url($story['main_image']);
            ?>
            <a href="story.php?story_id=<?= $story['id'] ?>">
                <img src="../../images/<?= $image_url ?>" alt="Photo of <?= $story['name'] ?> story">
                <h1><?= $story['name'] ?></h1>
            </a>
        <br></br>
<?php

        }
    }
?>