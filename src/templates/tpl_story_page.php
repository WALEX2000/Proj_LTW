<?php
include_once('../database/comment_queries.php');

function draw_story_info($story_info, $story_images, $story_main_image, $username)
{
    ?>
        <div id="imageViewerCropper">
            <button type="button" class = "arrowButton" id="houseBack"><i class="fa fa-chevron-left fa-5x"></i></button>
            <button type="button" class = "arrowButton" id="houseFront"><i class="fa fa-chevron-right fa-5x"></i></button>
            <div id="imageViewer">
                <img src="../../images/<?= $story_main_image ?>" class="houseImage" alt="Photo of  <?= $story_info['name'] ?>">
                <?php
                display_all_images($story_images, $story_main_image);
                ?>
            </div>
        </div>
            <?php
            if ($username == $story_info['owner']) {
                ?>
            <a href="edit_story.php" id="editStoryLink"><button id="editStory" type="submit" onclick=""><i class="fa fa-pencil fa-4x" aria-hidden="true"></i></button></a>

        <?php
            }
            if ($story_info['number_ratings'] != 0) {
                $average_ratings = (float) $story_info['sum_ratings'] / (float) $story_info['number_ratings'];
            } else {
                $average_ratings = 0;
            }
            ?>
        <div id="nameBox">
            <h1><?= $story_info['name'] ?></h1>
            <p><?= $story_info['country'] ?> (<?= $story_info['city'] ?>)</p>
        </div>
        <div id="bottomDiv">
            <div id="descriptionBox">
                <p><b>Description:</b> <?= $story_info['details'] ?></p>
                <p><b>Max Capacity:</b> <?= $story_info['capacity'] ?> people</p>
                <p><b>Available Since:</b> <?= $story_info['post_date'] ?></p>
                <p><b>Price Per Night:</b> <?= $story_info['price_per_night'] ?>€</p>
                <p><b>Address:</b> <?= $story_info['address'] ?></p>
                <p id="ratingText"><b>Rating:</b> <?= number_format($average_ratings, 1) ?> from <?= $story_info['number_ratings'] ?> ratings</p>
                <div class="rating_display">
                    <?php
                        for ($x = 0; $x < round($average_ratings); $x++) {
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
            </div>
    <?php

    }

    function display_all_images($images, $story_main_image)
    {
        foreach ($images as $image) {
            if($image['url'] == $story_main_image) continue;
            ?>
        <img src="../../images/<?= $image['url'] ?>" class="houseImage" alt="Photo with url = <?= $image['url'] ?>">
    <?php


        }
    }

    function draw_reserve_form($username, $owner, $capacity, $ppn)
    {
        if ($username != $owner) {
            ?>
        <div id="reservationForm">
            <?php
                    draw_messages();
                    ?>
            <input id="ppn" value="<?= $ppn ?>" style="display:none"/>
            <form action="../actions/action_reserve.php" method="post">
                <label> Check-in date: <input id="checkInRes" type="date" name="start_date" required> </label>
                <label> Check-out date: <input id="checkOutRes" type="date" name="end_date" required> </label>
                <label id="ppn"> Total Price: <p id="totalPriceRes"> 0€</p></label>
                <label> Number of guests: <input type="number" name="num_guests" min=1 max=<?= $capacity ?> value=1 required> </label>
                <button id="reserveButton" type="submit" value="Reserve">Book Stay</button>
            </form>
        </div>
    <?php
        }
    }

    function draw_reservations($username, $owner, $reservations)
    {
        if ($username == $owner) {
        ?>
            <div id="reservations">
            <div id="reservationsHeader">
                <h1>Reservations</h1>
            </div>
            <div id="reservationsList">
        <?php
            foreach ($reservations as $reservation) {
                $user_info = get_user_info($reservation['renter']);
                $profile_image_url = get_image_url($user_info['profile_image']);
        ?>
            <div class="reservationBlock">
                <div class="cropper">
                    <img class="profileImg" src="../../images/<?= $profile_image_url ?>" />
                </div>
                <h1 class="renterName"><?= $reservation['renter'] ?></h2>
                <p><b>Dates: </b><?= $reservation['stay_start'] ?> - <?= $reservation['stay_end'] ?></p>
                <p><b>Number of guests: </b><?= $reservation['number_of_people'] ?></p>
                <h2>Total amount: <?= $reservation['total_price'] ?>€</h2>
            <?php
                if ($reservation['stay_start'] >= date('Y-m-d', strtotime("+5 days"))) {
                    $_SESSION['rent_id'] = $reservation['id'];
            ?>
                    <a href="../actions/action_cancel_reservation.php" class="cancelButtonLink"><button class="cancelReservation" type="submit" onclick="">Cancel</button></a>
    <?php
                }
    ?>
                </div>
    <?php
            }
    ?>
            </div>
            </div>
    <?php
        }
    }

    function draw_edit_story_form($story_info)
    {
        ?>
    <div id="body">
    <h1>Edit Story</h1>
    <?php
        draw_messages();
        ?>
    <form action="../actions/action_edit_story.php" method="post">
        <label> <p>Name</p> <input type="text" name="name" value="<?= $story_info['name'] ?>"> </label>
        <label> <p>Country</p> <input type="text" name="country" value="<?= $story_info['country'] ?>"> </label>
        <label> <p>City</p> <input type="text" name="city" value="<?= $story_info['city'] ?>"> </label>
        <label> <p>Address</p> <input type="text" name="address" value="<?= $story_info['address'] ?>"> </label>
        <label> <p>Details</p> <input type="text" name="details" value="<?= $story_info['details'] ?>"> </label>
        <label> <p>Price Per Night</p> <input type="double" name="price_per_night" value="<?= $story_info['price_per_night'] ?>"> </label>
        <label> <p>Capacity</p> <input type="number" name="capacity" min=1 value="<?= $story_info['capacity'] ?>"> </label>
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <input id="addButton" type="submit" value="Update" />
    </form>
    <?php
    }

    function draw_search_results()
    {
        ?>
        <div id="body">
        <?php
        $results = $_SESSION['search_results'];
        if ($results === null) {
            ?> <h2>No results found</h2> <?php
        } else 
        {
            foreach ($results as $result) {
                $info = get_story_info($result['id']);
                $name = $info['name'];
                $address = $info['address'];
                $guests = $info['capacity'];
                $details = $info['details'];
                $country = $info['country'];
                $city = $info['city'];
                $main_image = get_image_url($info['main_image'])

                ?>
            <a href="story.php?story_id=<?= $result['id'] ?>">
                <div class="search_result_container">
                    <div class="topInfo_container">
                        <p><?= $name ?></p>
                        <p class="searchLocation"><?= $country ?>(<?= $city ?>)</p>
                    </div>
                    <div class="flex">
                        <div class="result_image_container">
                                <img class="result_image" src="../../images/<?=$main_image?>" alt="Awesome Photo of this house ->" />
                        </div>
                        <div class="bottomInfo_container">
                            <p>Max Capacity: <?= $guests ?></p>
                            <p>Details: <?= $details ?></p>
                        </div>
                    </div>
                </div>
            </a>
        <?php
            }
        ?>
        </div>
        <?php
        }
     }

        function draw_comment_form($username, $owner)
        {
            if ($username != $owner) {
                $user_info = get_user_info($username);
                $image_url = get_image_url($user_info['profile_image']);
                ?>
                <div class="comment_container">
                    <div class="postCommentTop">
                        <div class="cropper">
                            <img class="profileImg" src="../../images/<?= $image_url ?>" alt="Commenter's profile image" />
                        </div>
                        <p class="name"><?= $user_info['name'] ?></p>
                    </div>
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
                            <div class="comment_content_container">
                                <textarea id="commentTextArea" name="comment" form="comment_form" placeholder="Enter your comment here..." required></textarea>
                            </div>
                            <button id="postComment"type="submit" value="Send comment">Post Comment</button>
                        </form>
                </div>
        <?php
            }
        }

    function draw_all_comments($comments, $owner, $username)
    {
        ?>
        <div class = "all_comments">
        
    <?php
        foreach ($comments as $comment) {
            $user_info = get_user_info($comment['username']);
            $image_url = get_image_url($user_info['profile_image']);
            ?>
        <div class="comment_container">
            <div class="comment_header">
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
                <div class="cropper">
                    <img class="profileImg" src="../../images/<?= $image_url ?>" alt="Commenter's profile image" />
                </div>
                <p class="name"><?= $user_info['name'] ?></p>
                <p class="commentDate"><?= $comment['comment_date'] ?></p>
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
                                <div class="cropper">
                                    <img class="profileImg" src="../../images/<?= $replyer_image_url ?>" alt="Commenter's profile image" />
                                </div>
                                <p class="name extraWidth"><?= $replyer_info['name'] ?></p>
                                <?= $reply['comment_date'] ?>
                            </div>
                            <div class="comment_content_container">
                                <?= $reply['content'] ?>
                            </div>
                        </div>
                        <?php
                    } else if ($username == $owner) {
                        $user_info = get_user_info($username);
                        $user_image_url = get_image_url($user_info['profile_image']);
                    ?>
                        <div class="reply_container">
                            <div class="comment_header">
                                <div class="cropper">
                                    <img class="profileImg" src="../../images/<?= $user_image_url  ?>" alt="Commenter's profile image" />
                                </div>
                                <p class="name extraWidth"><?= $user_info['name'] ?></p> <br></br>
                            </div>
                            <form action="../actions/action_add_reply.php" id="reply_form" method="post">
                                <div class="comment_content_container">
                                    <textarea id="commentTextArea" name="reply_content" placeholder="Enter your reply here..." required></textarea>
                                </div>
                                <input type="hidden" name="comment" value=<?= $comment['id'] ?>>
                                <button id="postReply" type="submit" value="Send reply">Post Reply</button>
                            </form>
                        </div>
                    <?php
                    }
                    ?>
        </div>
    <?php
        }
    }
    ?>
