<?php
include_once('../database/image_queries.php');
include_once('../includes/session.php');

function draw_user_info($user_info, $image_url)
{
    $dob = new DateTime($user_info['birthday']);
    //We need to compare the user's date of birth with today's date.
    $now = new DateTime();
    //Calculate the time difference between the two dates.
    $difference = $now->diff($dob);    
    //Get the difference in years, as we are looking for the user's age.
    $age = $difference->y;
    ?>
    <div id="userPanel">
        <div id="user_info">
        <a href="edit_profile.php" id="editButtonTotal"><button id="editButton" type="submit" onclick=""><i class="fa fa-pencil fa-4x" aria-hidden="true"></i></button></a>
            <div id="profileContainer">
                <img src="../../images/<?= $image_url ?>" id="profilePicture" alt="Photo of <?= $user_info['name'] ?>">
            </div>
            <h2 class="userInfoText"><?= $user_info['name'] ?></h2>
            <h3 class="userInfoText"><?= $user_info['nationality'] ?> | <?= $age ?> years old</h3>
        </div>
        <div>
            <button id="pastTripsButton" class="panelButton">Past Trips</button>
            <button id="upcomingTripsButton" class="panelButton">Upcoming Trips</button>
            <button id="ownedHousesButton" class="panelButton">Owned Houses</button>
        </div>
    </div>
<?php
}

function draw_rented_stories($rented)
{
    ?>
    <div id="housesPanel">
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
    </div>
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

