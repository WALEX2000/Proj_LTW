<?php
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
            ?>
        <h1><?= $story_info['name'] ?></h1>
        <h3><?= $story_info['country'] ?></h3>
        <h2><?= $story_info['city'] ?></h2>
        <h2><?= $story_info['address'] ?></h2>
        <h2><?= $story_info['details'] ?></h2>
        <h2><?= $story_info['average_rating'] ?></h2>
        <h2><?= $story_info['post_date'] ?></h2>
        <h2><?= $story_info['price_per_night'] ?> €</h2>
        <h2><?= $story_info['capacity'] ?></h2>
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

    function draw_reserve_form($username, $owner)
    {
        if ($username != $owner) {
        ?>
    <div>
        <form action="../actions/action_reserve.php" method="post">
            <label> Check-in date: <input type="date" name="start_date" required> </label>
            <label> Check-out date: <input type="date" name="end_date" required> </label>
            <label> Number of guests: <input type="number" name="num_guests" min=1 required> </label>
            <input type="submit" value="Reserve" />
        </form>
        <br></br>
    </div>
    <?php
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


?>