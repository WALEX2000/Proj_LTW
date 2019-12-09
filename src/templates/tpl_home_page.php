<?php function draw_home($all_stories)
{ ?>
    <div id="body">
        <div id="TopHouseFrame">
            <img id="TopHouse" src="../../images/topHouse.jpg" alt="TopHouse" />
            <div class="BottomText">
                <p>Nome</p>
            </div>
        </div>
        <div id="SpotlightFrame">
            <div id="Recommendations" class="HousePreviewer">
                <div class="PreviewedHouse">
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
                    <div class="BottomTextPreview">
                        <p>Nome</p>
                    </div>
                </div>
                <div class="PreviewedHouse">
                    <img src="../../images/topHouse.jpg" class="PreviewedHouseImage" />
                    <div class="BottomTextPreview">
                        <p>Nome</p>
                    </div>
                </div>
                <div class="PreviewedHouse">
                    <img src="../../images/Room2.jpg" class="PreviewedHouseImage" />
                    <div class="BottomTextPreview">
                        <p>Nome</p>
                    </div>
                </div>
            </div>
            <div id="Trending" class="HousePreviewer">
                <div class="PreviewedHouse">
                    <img src="../../images/Room1.jpg" class="PreviewedHouseImage" />
                    <div class="BottomTextPreview">
                        <p>Nome</p>
                    </div>
                </div>
                <div class="PreviewedHouse">
                    <img src="../../images/Room1.jpg" class="PreviewedHouseImage" />
                    <div class="BottomTextPreview">
                        <p>Nome</p>
                    </div>
                </div>
                <div class="PreviewedHouse">
                    <img src="../../images/Room2.jpg" class="PreviewedHouseImage" />
                    <div class="BottomTextPreview">
                        <p>Nome</p>
                    </div>
                </div>
            </div>
            <div id="NewAdditions" class="HousePreviewer">
                <div class="PreviewedHouse">
                    <img src="../../images/Room1.jpg" class="PreviewedHouseImage" />
                    <div class="BottomTextPreview">
                        <p>Nome</p>
                    </div>
                </div>
                <div class="PreviewedHouse">
                    <img src="../../images/Room2.jpg" class="PreviewedHouseImage" />
                    <div class="BottomTextPreview">
                        <p>Nome</p>
                    </div>
                </div>
                <div class="PreviewedHouse">
                    <img src="../../images/topHouse.jpg" class="PreviewedHouseImage" />
                    <div class="BottomTextPreview">
                        <p>Nome</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>