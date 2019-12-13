<?php
function draw_add_story_form()
{
    ?>
    <h1>Add new house</h1>
    <?php
        draw_messages();
        ?>
    <form action="../actions/action_add_story.php" method="post" enctype='multipart/form-data'>
        <label> Title <input type="text" name="title" required> </label>
        <label> Country <input type="text" name="country" required> </label>
        <label> City <input type="text" name="city" required> </label>
        <label> Address <input type="text" name="address" required> </label>
        <label> Details <input type="text" name="details" required> </label>
        <label> Price Per Night <input type="double" name="price_night" required> </label>
        <label> Capacity <input type="number" name="capacity" min="1" required> </label>
        <label> Main Image <input type="file" name="main_image" id="main_image" required>
        <label> Other Images <input type="file" name="other_images[]" id="other_images" multiple="multiple">
            <input type="submit" value="Add" />
    </form>
<?php
}
?>