<?php
function draw_story_info($story_info, $story_images, $username)
{
    ?>
    <div id="story_info">
        <?php

            display_all_images($story_images);
            if ($username == $story_info['owner']) { 
            ?>
        
                <button id="editStory" type="submit" onclick=""><i class="fa fa-home"></i></button>

                <?php
            }
            ?>
        <h1><?= $story_info['name'] ?></h1>
        <h3><?= $story_info['country'] ?></h3>
        <h2><?= $story_info['city'] ?></h2>
        <h2><?= $story_info['address'] ?></h2>
        <h2><?= $story_info['details'] ?></h2>
        <h2><?= $story_info['average_rating'] ?></h2>
        <h2><?= $story_info['post_date'] ?></h2>
        <h2><?= $story_info['price_per_night'] ?> €</h2>
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