<?php
    function draw_add_story_form(){
        ?>
        <h1>Add new house</h1>
        <form action ="../actions/action_add_story.php" method= "post">
           <label> Title <input type="text" name= "title" required> </label>
           <label> Country <input type="text" name= "country" required> </label>
           <label> City <input type="text" name= "city" required> </label>
           <label> Address <input type="text" name= "address" required> </label>
           <!-- Upload images and choose main one-->
           <label> Details <input type="text" name= "details" required> </label>
           <label> Price Per Night <input type="double" name= "price_night" required> </label>
           <label> Capacity <input type="number" min=1 name= "capacity" required> </label>
           <input type = "submit" value = "Add"/>
        </form>
       <?php 
    }
?>