<?php function draw_home($all_stories)
{ ?>
    <div id="body">
                <div id="SpotlightBox">
                    <div id="Recommendations" class="HousePreviewer">
                        <h1>Recommendations</h1>
                        <?php
                        foreach ($all_stories as $story) {
                            $image_url = get_image_url($story['main_image']);
                                ?>
                                <a href="story.php?story_id=<?= $story['id'] ?>">
                                    <img src="../../images/<?= $image_url ?>" alt="Photo of <?= $story['name'] ?> story">
                                </a>
                                <br></br>
                                <?php
                            
                        }
                        ?>
                    </div>
                    <div id="Trending" class="HousePreviewer">
                        <h1>Trending</h1>
                    </div>
                    <div id="NewAdditions" class="HousePreviewer">
                        <h1>NewAdditions</h1>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php } ?>