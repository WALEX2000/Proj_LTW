<?php
    function draw_register_form(){
        ?>
        <h1>Register new user</h1>
        <form action ="../actions/action_register.php" method= "post">
           <label> Username <input type="text" name= "username" required> </label>
           <label> Name <input type="text" name= "name" required> </label>
           <label> Email <input type="text" name= "email" required> </label>
           <label> Birthday <input type="text" name= "birthday" required> </label>
           <label> Nationality <input type="text" name= "nationality" required> </label>
           <label> Password <input type="password" name= "password" required> </label>
           <input type = "submit" value = "Register"/>
        </form>
       <?php 
    }

    function draw_login(){
        ?>
        <h1>Login</h1>
        <form action ="../actions/action_login.php" method= "post">
           <label> Username <input type="text" name= "username" required> </label>
           <label> Password <input type="password" name= "password" required> </label>
           <input type = "submit" value = "Login"/>
        </form>
       <?php 
    }
?>