<?php
include_once('../database/image_queries.php');
include_once('../database/comment_queries.php');
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
            <div id="editButtonTotal"><button id="editButton" type="button"><i class="fa fa-pencil fa-4x" aria-hidden="true"></i></button></div>
            <div id="profileContainer">
                <img src="../../images/<?= $image_url ?>" id="profilePicture" alt="Photo of <?= $user_info['name'] ?>">
            </div>
            <h2 class="userInfoText"><?= $user_info['name'] ?></h2>
            <h3 class="userInfoText"><?= $user_info['nationality'] ?> | <?= $age ?> years old</h3>
        </div>
        <div>
            <button id="tripsButton" class="panelButton">Your Trips</button>
            <button id="ownedHousesButton" class="panelButton">Owned Houses</button>
        </div>
    </div>
<?php
}

function draw_rented_stories($rented)
{
    ?>
    <div id="userTrips" class="currentPanel">
        <?php
            if ($rented != FALSE) {
                foreach ($rented as $story) {
                    $image_url = get_image_url($story['main_image']);
                    ?>
                <div class="trip">
                    <a href="story.php?story_id=<?= $story['story'] ?>">
                        <img src="../../images/<?= $image_url ?>" class="tripImg" alt="Photo of <?= $story['name'] ?> story">
                        <div class="houseInfo">
                            <p><?= $story['name'] ?> - <?= $story['country'] ?>(<?= $story['city'] ?>)</p>
                            <?php
                            $commented = has_commented($story['story'], $rented['renter']);
                            print_r($commented);

                            if ($story['stay_start'] >= date('Y-m-d', strtotime("+5 days"))) {
                                $_SESSION['rent_id'] = $story['id'];
                                ?>
                            <a href="../actions/action_cancel_reservation.php"><button class="cancelReservation" type="submit" onclick="">Cancel</button></a>
                            <?php
                                } else if (count($commented) === 0) {
                            ?>
                                <a href="story.php?story_id=<?= $story['story'] ?>"><button class="rateTrip" type="submit" onclick="">Rate this Trip!</button></a>
                            <?php
                                } else if (count($commented) !== 0){
                                    $your_rating = $commented['rate'];
                            ?>
                                <div class="ratingCenter">
                                    <?php
                                                for ($x = 0; $x < round($your_rating); $x++) {
                                                    ?>
                                        <div class="yellowStar star">★</div>
                                    <?php } ?>
                                    <?php
                                                for ($x = 0; $x < 5 - round($your_rating); $x++) {
                                                    ?>
                                        <div class="greyStar star">★</div>
                                    <?php } ?>
                                </div>
                            <?php
                                }
                            ?>                            
                            <p class="tripDates"><?= $story['stay_start'] ?> - <?= $story['stay_end'] ?></p>
                        </div>
                    </a>
                </div>
                <?php
                }
            } else {
                ?> <h2> No houses rented yet </h2><?php
            }
        ?>
    </div>
<?php
}

function draw_renting_stories($renting)
{
    ?>
    <div id="ownedHouses" class="hiddenPanel">
        <?php
            if ($renting != FALSE) {
                foreach ($renting as $story) {
                    $image_url = get_image_url($story['main_image']);
                    if ($story['number_ratings'] != 0) {
                        $average_ratings = (float) $story['sum_ratings'] / (float) $story['number_ratings'];
                    } else {
                        $average_ratings = 0;
                    }
                    ?>
                <div class="ownedHouse">
                    <a href="story.php?story_id=<?= $story['id'] ?>">
                        <img src="../../images/<?= $image_url ?>" class="ownedHouseImg" alt="Photo of <?= $story['name'] ?> house">
                        <div class="houseInfo">
                            <p><?= $story['name'] ?> - <?= $story['country'] ?>(<?= $story['city'] ?>)</p>
                            <div class="rating">
                                <?php
                                            for ($x = 0; $x < round($average_ratings); $x++) {
                                                ?>
                                    <div class="yellowStar star">★</div>
                                <?php } ?>
                                <?php
                                            for ($x = 0; $x < 5 - round($average_ratings); $x++) {
                                                ?>
                                    <div class="greyStar star">★</div>
                                <?php } ?>
                            </div>
                        </div>
                    </a>
                </div>
                <br></br>
            <?php
                    }
                } else {
                    ?> <h2> No houses submited yet </h2><?php
                }
            ?>
    </div>
<?php
}
?>