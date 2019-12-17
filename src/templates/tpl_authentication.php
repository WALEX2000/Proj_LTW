<?php
include_once('../includes/session.php');
include_once('tpl_common.php');


function draw_register()
{
   ?>
   <div id="register_modal" class="modal">
            <div class="modal-content animate">
            <?php
            draw_messages();
            ?>
                <form id="register_form" action="../actions/action_register.php" method="post" enctype="multipart/form-data">
                    <div class="input-div">
                        <label> Username <input type="text" name="username" required> </label>
                        <label> Name <input type="text" name="name" required> </label>
                        <label> Email <input type="text" name="email" required> </label>
                        <label> Birthday <input type="date" name="birthday" required> </label>
                        <label> Nationality <input type="text" name="nationality" required> </label>
                        <label> Password <input type="password" name="password" required> </label>
                        <label> Profile Image <input type="file" name="profile_img" id="profile_img">  </label>
                        <button type="submit">Register</button>
                    </div>
                </form>
      </div>
   </div>
<?php
}

function draw_login()
{
   ?>
   <div id="login_modal" class="modal">
      <div class="modal-content animate">
         <?php
         draw_messages();
         ?>
            <form id="login_form" action="../actions/action_login.php" method="post">
               <div class="input-div">
                  <label> Username <input type="text" name="username" required> </label>
                  <label> Password <input type="password" name="password" required> </label>
                  <button type="submit">Login</button>
               </div>
          </form>
          <h2 id="registerPrompt">Don't have an account?</h2>
          <a href="../pages/register.php">
            <button id="registerPromptButton">Register</button>
         </a>
      </div>
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
   <form method="post">
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