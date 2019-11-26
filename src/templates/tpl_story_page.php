<?php
function draw_story_info($story_info, $story_images)
{
    ?>
    <div id="story_info">
    <?php
    display_all_images($story_images);
    ?>
    <h1><?= $story_info['name'] ?></h1>
        <h3><?= $story_info['country'] ?></h3>
        <h2><?= $story_info['city'] ?></h2>
        <h2><?= $story_info['address'] ?></h2>
        <h2><?= $story_info['details'] ?></h2>
        <h2><?= $story_info['average_rating'] ?></h2>
        <h2><?= $story_info['post_date'] ?></h2>
        <h2><?= $story_info['price_per_night'] ?></h2>
    </div>

    <?php

    }

    function display_all_images($images)
    {
        foreach ($images as $image) {
            ?>
        <img src="../../images/<?= $image['url']?>" alt="Photo with url = <?= $image['url']?>">
<?php
    }
}
?>