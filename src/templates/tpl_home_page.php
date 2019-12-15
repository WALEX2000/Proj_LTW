<?php function draw_home($top_stories, $most_recent_stories, $most_rented)
{ ?>
    <div id="body">
        <div id="TopHouseFrame">
            <?php {
                    if (count($top_stories) !== 0) {
                        $image_url = get_image_url($top_stories[0]['main_image']);
                        //$log = "<script> console.log(" . json_encode($story, JSON_HEX_TAG) . "); </script>";
                        //echo $log;
                        ?>
                    <a href="story.php?story_id=<?= $top_stories[0]['id'] ?>">
                        <img id="TopHouse" src="../../images/<?= $image_url ?>" alt="TopHouse" />
                    </a>
                    <div class="BottomText">
                        <p><?= $top_stories[0]['name'] ?> - <?= $top_stories[0]['city'] ?></p>
                    </div>
            <?php
                    }else{
                        ?> <h4> No houses to show </h4><?php
                    }
                }
                ?>
        </div>
        <div id="SpotlightFrame">
            <div id="Recommendations" class="HousePreviewer">
                <button type="button" class="arrowButton" id="recommendedBack"><i class="fa fa-chevron-left fa-5x"></i></button>
                <?php
                    //TODO change query for each preview
                    foreach ($top_stories as $story) {
                        $image_url = get_image_url($story['main_image']);
                        ?>
                    <div class="PreviewedHouse RecommendedHouse">
                        <a href="story.php?story_id=<?= $story['id'] ?>">
                            <img src="../../images/<?= $image_url ?>" alt="Photo of <?= $story['name'] ?> story" class="PreviewedHouseImage" />
                        </a>
                        <div class="BottomTextPreview">
                            <p><?= $story['name'] ?> - <?= $story['city'] ?></p>
                        </div>
                    </div>
                <?php
                    }
                    ?>
                <button type="button" class="arrowButton" id="recommendedFront"><i class="fa fa-chevron-right fa-5x"></i></button>
            </div>
            <div id="Trending" class="HousePreviewer">
                <button type="button" class="arrowButton" id="trendingBack"><i class="fa fa-chevron-left fa-5x"></i></button>
                <?php
                    foreach ($most_rented as $story) {
                        $image_url = get_image_url($story['main_image']);
                        ?>
                    <div class="PreviewedHouse TrendingHouse">
                        <a href="story.php?story_id=<?= $story['id'] ?>">
                            <img src="../../images/<?= $image_url ?>" alt="Photo of <?= $story['name'] ?> story" class="PreviewedHouseImage" />
                        </a>
                        <div class="BottomTextPreview">
                            <p><?= $story['name'] ?> - <?= $story['city'] ?></p>
                        </div>
                    </div>
                <?php
                    }
                    ?>
                <button type="button" class="arrowButton" id="trendingFront"><i class="fa fa-chevron-right fa-5x"></i></button>
            </div>
            <div id="NewAdditions" class="HousePreviewer">
                <button type="button" class="arrowButton" id="newBack"><i class="fa fa-chevron-left fa-5x"></i></button>
                <?php
                    foreach ($most_recent_stories as $story) {
                        $image_url = get_image_url($story['main_image']);
                        ?>
                    <div class="PreviewedHouse NewHouse">
                        <a href="story.php?story_id=<?= $story['id'] ?>">
                            <img src="../../images/<?= $image_url ?>" alt="Photo of <?= $story['name'] ?> story" class="PreviewedHouseImage" />
                        </a>
                        <div class="BottomTextPreview">
                            <p><?= $story['name'] ?> - <?= $story['city'] ?></p>
                        </div>
                    </div>
                <?php
                    }
                    ?>
                <button type="button" class="arrowButton" id="newFront"><i class="fa fa-chevron-right fa-5x"></i></button>
            </div>
        </div>
    </div>
<?php }



?>