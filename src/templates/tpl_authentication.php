<?php
include_once('../includes/session.php');
include_once('tpl_common.php');


function draw_register()
{
   ?>
   <div id="register_form" enctype='multipart/form-data'>
      <h1>Register new user</h1>
      <?php
         draw_messages();
         ?>
      <form action="../actions/action_register.php" method="post" enctype="multipart/form-data">
         <label> Username <input type="text" name="username" required> </label>
         <label> Name <input type="text" name="name" required> </label>
         <label> Email <input type="text" name="email" required> </label>
         <label> Birthday <input type="date" name="birthday" required> </label>
         <label> Nationality <input type="text" name="nationality" required> </label>
         <label> Password <input type="password" name="password" required> </label>
         <label> Profile Image <input type="file" name="profile_img" id="profile_img">
            <input type="submit" value="Register" />
      </form>
   </div>
<?php
}

function draw_login()
{
   ?>
   <div id="login_form">
      <h1>Login</h1>
      <?php
         draw_messages();
         ?>
      <form action="../actions/action_login.php" method="post">
         <label> Username <input type="text" name="username" required> </label>
         <label> Password <input type="password" name="password" required> </label>
         <input type="submit" value="Login" />
      </form>
      <h2>Don't have an account?</h2><button onclick="document.getElementById('login_modal').style.display='none';
         document.getElementById('register_modal').style.display='block'">Register</button>
   </div>
<?php
}

function draw_edit_profile_form($user_info)
{
   ?>
   <div id="editProfilePanel" class="hiddenPanel">
   <div id="editProfileDiv">
   <h1>Edit Profile</h1>
   <?php
      draw_messages();
      ?>
   <form action="../actions/action_edit_profile.php" method="post">
      <label> <p>Account Password</p> <input type="password" name="current_password" required> </label>
      <label> <p>New Password</p> <input type="password" name="new_password" placeholder="Leave empty if you don't want to change"> </label>
      <label> <p>New name</p> <input type="text" name="name" value="<?= $user_info['name'] ?>"> </label>
      <label> <p>New email</p> <input type="text" name="email" value="<?= $user_info['email'] ?>"> </label>
      <label> <p>Birthday</p> <input type="date" name="birthday" value="<?= $user_info['birthday'] ?>"> </label>
      <label> <p>Nationality</p> <input type="text" name="nationality" value="<?= $user_info['nationality'] ?>"> </label>
      <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
      <input type="submit" value="Update" />
   </form>
   </div>
   </div>
<?php
}
?>