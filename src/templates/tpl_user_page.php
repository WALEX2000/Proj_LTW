<?php
include_once('../database/image_queries.php');

function draw_user_info($user_info, $image_url)
{
    ?> <div id="user_info">
        <img src="../../images/<?= $image_url ?>" alt="Photo of <?= $user_info['name'] ?>">
        <h1><?= $user_info['name'] ?></h1>
        <h3><?= $user_info['username'] ?></h3>
        <h2><?= $user_info['email'] ?></h2>
        <h2><?= $user_info['birthday'] ?></h2>
        <h2><?= $user_info['nationality'] ?></h2>
    </div>
    <?php
    }

    function draw_rented_stories($rented)
    {
        foreach ($rented as $story) {
            $image_url = get_image_url($story['main_image']);
            ?>
        <a href="story.php?story_id=<?= $story['story'] ?>">
            <img src="../../images/<?= $image_url ?>" alt="Photo of <?= $story['name'] ?> story">
            <h1><?= $story['name'] ?></h1>
            <h1><?= $story['stay_start'] ?></h1>
            <h1><?= $story['stay_end'] ?></h1>
        </a>
        <br></br>
<?php

    }
}
?>