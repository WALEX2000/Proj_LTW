<?php
function draw_add_story_form()
{
    ?>
    <div id="body">
    <h1>Add new house</h1>
    <?php
        draw_messages();
        ?>
    <form action="../actions/action_add_story.php" method="post" enctype='multipart/form-data'>
        <label> <p>Title</p> <input type="text" name="title" required> </label>
        <label> <p>Country</p> <input type="text" name="country" required> </label>
        <label> <p>City</p> <input type="text" name="city" required> </label>
        <label> <p>Address</p> <input type="text" name="address" required> </label>
        <label> <p>Details</p> <input type="text" name="details" required> </label>
        <label> <p>Price Per Night</p> <input type="double" name="price_night" required> </label>
        <label> <p>Capacity</p> <input type="number" name="capacity" min="1" required> </label>
        <label> <p>Main Image</p> <input type="file" name="main_image" id="main_image" required>  </label>
        <label> <p>Other Images</p> <input type="file" name="other_images[]" id="other_images" multiple="multiple">  </label>
        <input id="addButton" type="submit" value="Add" />
    </form>
    </div>
<?php
}
?>