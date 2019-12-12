<?php
include_once('../database/comment_queries.php');

function draw_story_info($story_info, $story_images, $username)
{
    ?>
    <div id="story_info">
        <?php

            display_all_images($story_images);
            if ($username == $story_info['owner']) {
                ?>
            <a href="edit_story.php"><button id="editStory" type="submit" onclick=""><i class="fa fa-home"></i></button></a>

        <?php
            }
            if ($story_info['number_ratings'] != 0) {
                $average_ratings = (float) $story_info['sum_ratings'] / (float) $story_info['number_ratings'];
            } else {
                $average_ratings = 0;
            }
            ?>
        <h1><?= $story_info['name'] ?></h1>
        <h3><?= $story_info['country'] ?></h3>
        <h2><?= $story_info['city'] ?></h2>
        <h2><?= $story_info['address'] ?></h2>
        <h2><?= $story_info['capacity'] ?></h2>
        <h2><?= $story_info['details'] ?></h2>
        <h2><?= $story_info['post_date'] ?></h2>
        <h2><?= $story_info['price_per_night'] ?> €</h2>
        <h2><?= $story_info['capacity'] ?></h2>
        <div class="rating_display">
            <?php
                for ($x = 0; $x <round($average_ratings); $x++) {
                    ?>
                <div class="rating_given_display">
                    ★
                </div>
            <?php
                }
                for ($x = 0; $x < 5 - round($average_ratings); $x++) {
                    ?>
                <div class="rating_left_display">
                    ★
                </div>
            <?php
                }
                ?>
        </div>

        <h2>Average is <?= $average_ratings ?> of <?= $story_info['number_ratings'] ?> ratings</h2>

    </div>
    <?php

    }

    function display_all_images($images)
    {
        foreach ($images as $image) {
            ?>
        <img src="../../images/<?= $image['url'] ?>" alt="Photo with url = <?= $image['url'] ?>">
        <?php
            }

            function draw_reserve_form($username, $owner, $capacity)
            {
                if ($username != $owner) {
                    ?>
            <div>
                <form action="../actions/action_reserve.php" method="post">
                    <label> Check-in date: <input type="date" name="start_date" required> </label>
                    <label> Check-out date: <input type="date" name="end_date" required> </label>
                    <label> Number of guests: <input type="number" name="num_guests" min=1 max=<?= $capacity ?> value=1 required> </label>
                    <input type="submit" value="Reserve" />
                </form>
                <br></br>
            </div>
    <?php
            }
        }
    }

    function draw_reservations($username, $owner, $reservations){
        //TODO: possibly only the reservations happening now or in the future???
        if ($username == $owner) {
            ?><h1>Reservations</h1> <?php
            foreach($reservations as $reservation){           
            ?>
        <div>
            
            <h2><?= $reservation['renter'] ?></h2>
            <h3><?= $reservation['stay_start'] ?></h3>
            <h2><?= $reservation['stay_end'] ?></h2>
            <h2><?= $reservation['number_of_people'] ?></h2>
            <h2><?= $reservation['total_price'] ?> €</h2>
            
        </div>
        <?php
                if ($reservation['stay_start'] >= date('Y-m-d', strtotime("+5 days"))){
                    $_SESSION['rent_id'] = $reservation['id'];
                    ?>
                    <a href="../actions/action_cancel_reservation.php"><button id="cancelReservation" type="submit" onclick="">Cancel</button></a>
                    <?php
                }
            }
        }
    }
    
    function draw_edit_story_form($story_info)
    {
        ?>
    <h1>Edit Story</h1>
    <form action="../actions/action_edit_story.php" method="post">
        <label> Name <input type="text" name="name" value="<?= $story_info['name'] ?>"> </label>
        <label> Country <input type="text" name="country" value="<?= $story_info['country'] ?>"> </label>
        <label> City <input type="text" name="city" value="<?= $story_info['city'] ?>"> </label>
        <label> Address <input type="text" name="address" value="<?= $story_info['address'] ?>"> </label>
        <label> Details <input type="text" name="details" value="<?= $story_info['details'] ?>"> </label>
        <label> Price Per Night <input type="double" name="price_per_night" value="<?= $story_info['price_per_night'] ?>"> </label>
        <label> Capacity <input type="number" name="capacity" min=1 value="<?= $story_info['capacity'] ?>"> </label>
        <input type="submit" value="Update" />
    </form>
    <?php
    }

    function draw_search_results()
    {
        $results = $_SESSION['search_results'];
        foreach ($results as $result) {
            $info = get_story_info($result['id']);
            $name = $info['name'];
            $address = $info['address'];
            $guests = $info['capacity'];
            $details = $info['details'];
            $country = $info['country'];
            $city = $info['city'];

            ?>
        <!--TODO: ADICIONAR LINK PARA CADA STORY-->
        <div class="search_result_container">
            <div class="result_image_container">
                <img class="result_image" src="../../images/Room1.jpg" alt="Awesome Photo of this house ->" />
            </div>
            <div class="info_container">
                <h2><?= $name ?></h2>
                <p><?= $address ?></p>
                <p><?= $country ?></p>
                <p><?= $city ?></p>
                <p><?= $guests ?></p>
                <p><?= $details ?></p>
            </div>
        </div>
    <?php
        }
    }

    function draw_comment_form($username, $owner)
    {
        if ($username != $owner) {
            ?>

        <h1>Leave a comment</h1>
        <textarea name="comment" form="comment_form" placeholder="Enter your comment here..." required></textarea>
        <form action="../actions/action_add_comment.php" id="comment_form" method="post">
            <div class="rate">
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="text">1 star</label>
            </div>
            <input type="submit" value="Send comment">
        </form>
    <?php
        }
    }

    function draw_all_comments($comments, $owner, $username)
    {
        foreach ($comments as $comment) {
            $user_info = get_user_info($comment['username']);
            $image_url = get_image_url($user_info['profile_image']);
            ?>
        <div class="comment_container">
            <div class="comment_header">
                <img class="commenters_profile_image" src="../../images/<?= $image_url ?>" alt="Commenter's profile image" />
                <p><?= $user_info['name'] ?></p>
                <?php
                        if ($comment['rate'] != null) {

                            ?>
                    <div class="rating_display">
                        <?php
                                    for ($x = 0; $x < $comment['rate']; $x++) {
                                        ?>
                            <div class="rating_given_display">
                                ★
                            </div>
                        <?php
                                    }
                                    for ($x = 0; $x < 5 - $comment['rate']; $x++) {
                                        ?>
                            <div class="rating_left_display">
                                ★
                            </div>
                        <?php
                                    }
                                    ?>
                    </div>
                <?php
                        }
                        ?>
                <?= $comment['comment_date'] ?>
            </div>
            <div class="comment_content_container">
                <?= $comment['content'] ?>
            </div>
            <?php
                    $reply = get_reply($comment['id']);
                    if ($reply != null) {
                        $replyer_info = get_user_info($reply['username']);
                        $replyer_image_url = get_image_url($replyer_info['profile_image']);
                        ?>
                <div class="reply_container">
                    <div class="comment_header">
                        <img class="commenters_profile_image" src="../../images/<?= $replyer_image_url ?>" alt="Commenter's profile image" />
                        <p><?= $replyer_info['name'] ?></p>
                        <?= $reply['comment_date'] ?>
                    </div>
                    <div class="comment_content_container">
                        <?= $reply['content'] ?>
                    </div>
                </div>
                <?php
                        } else {
                            if ($username == $owner) {
                                ?>
                    <form action="../actions/action_add_reply.php" id="reply_form" method="post">
                        <textarea name="reply_content" placeholder="Enter your reply here..." required></textarea>
                        <input type="hidden" name="comment" value=<?= $comment['id'] ?>>
                        <input type="submit" value="Send reply">
                    </form>
            <?php
                        }
                    }
                    ?>
        </div>
<?php
    }

    function draw_reserve_form(){
        ?>
        <div>
        <form action ="../actions/action_reserve.php" method= "post">
           <label> Check-in date: <input type="date" name= "start_date" required> </label>
           <label> Check-out date: <input type="date" name= "end_date" required> </label>
           <label> Number of guests: <input type="number" name= "num_guests" min = 1 required> </label>
           <input type = "submit" value = "Reserve"/>
        </form>
        <br></br>
    </div>
    <?php
    }
}

?>