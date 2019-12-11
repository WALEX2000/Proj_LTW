<?php function draw_home($all_stories)
{ ?>
    <div id="body">
        <div id="TopHouseFrame">
        <?php
        {
            $array_rnd = array_rand($all_stories, 1);
            $story = $all_stories[$array_rnd];
            $image_url = get_image_url($story['main_image']);

            //$log = "<script> console.log(" . json_encode($story, JSON_HEX_TAG) . "); </script>";
            //echo $log;
        ?>    
            <img id="TopHouse" src="../../images/<?= $image_url ?>" alt="TopHouse" />
            <div class="BottomText">
                <p><?=$story['name']?> - <?=$story['city']?></p>
            </div>
        <?php
        }
        ?>
        </div>
        <div id="SpotlightFrame">
            <div id="Recommendations" class="HousePreviewer">
                <button type="button" class = "arrowButton"><i class="fa fa-chevron-left fa-5x"></i></button>
                <?php
                //TODO change query for each preview
                    foreach ($all_stories as $story) {
                        $image_url = get_image_url($story['main_image']);
                ?>
                    <div class="PreviewedHouse">
                        <a href="story.php?story_id=<?= $story['id'] ?>">
                            <img src="../../images/<?= $image_url ?>" alt="Photo of <?= $story['name'] ?> story" class="PreviewedHouseImage"/>
                        </a>
                        <div class="BottomTextPreview">
                            <p><?=$story['name']?> - <?=$story['city']?></p>
                        </div>
                    </div>
                <?php
                    }
                ?>
                <button type="button" class = "arrowButton"><i class="fa fa-chevron-right fa-5x"></i></button>
            </div>
            <div id="Trending" class="HousePreviewer">
                <button type="button" class = "arrowButton"><i class="fa fa-chevron-left fa-5x"></i></button>
                <?php
                    foreach ($all_stories as $story) {
                        $image_url = get_image_url($story['main_image']);
                ?>
                    <div class="PreviewedHouse">
                        <a href="story.php?story_id=<?= $story['id'] ?>">
                            <img src="../../images/<?= $image_url ?>" alt="Photo of <?= $story['name'] ?> story" class="PreviewedHouseImage"/>
                        </a>
                        <div class="BottomTextPreview">
                            <p><?=$story['name']?> - <?=$story['city']?></p>
                        </div>
                    </div>
                <?php
                    }
                ?>
                <button type="button" class = "arrowButton"><i class="fa fa-chevron-right fa-5x"></i></button>
            </div>
            <div id="NewAdditions" class="HousePreviewer">
                <button type="button" class = "arrowButton"><i class="fa fa-chevron-left fa-5x"></i></button>
                <?php
                    foreach ($all_stories as $story) {
                        $image_url = get_image_url($story['main_image']);
                ?>
                    <div class="PreviewedHouse">
                        <a href="story.php?story_id=<?= $story['id'] ?>">
                            <img src="../../images/<?= $image_url ?>" alt="Photo of <?= $story['name'] ?> story" class="PreviewedHouseImage"/>
                        </a>
                        <div class="BottomTextPreview">
                            <p><?=$story['name']?> - <?=$story['city']?></p>
                        </div>
                    </div>
                <?php
                    }
                ?>
                <button type="button" class = "arrowButton"><i class="fa fa-chevron-right fa-5x"></i></button>
            </div>
        </div>
    </div>
<?php } ?>