<?php
include_once('src/includes/session.php');
include_once('src/database/profile_queries.php');
include_once('src/database/image_queries.php');

function draw_header($stylesheet)
{ ?>
  <!DOCTYPE html>
  <html lang="en-US">

  <head>
    <meta charset="UTF-8">
    <title>Homie</title>
    <link href="src/css/<?= $stylesheet ?>" rel="stylesheet" />
    <link href="src/css/topBar.css" rel="stylesheet" />
    <link href="src/css/story.css" rel="stylesheet" />
    <link href="src/css/search_results.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <script src="src/javascript/topBar.js" defer></script>
    <script src="src/javascript/home.js" defer></script>

  </head>
  <?php if (isset($_SESSION['messages'])) {?>
        <section id="messages">
          <?php foreach($_SESSION['messages'] as $message) { ?>
            <div class="<?=$message['type']?>"><?=$message['content']?></div>
          <?php } ?>
        </section>
      <?php unset($_SESSION['messages']); } ?>

  <body>
    <div id="all">
      <div id="topBar">
        <a href="home.php">
          <img id="logo" src="../images/houseLogo.png" />
        </a>
        <div id="searchBar">
          <input id="searchField" type="text" placeholder="Search..">
          <button id="searchButton" type="submit" onclick=""><i class="fa fa-search fa-2x"></i></button>
        </div>

        <div class="dropdown">
            <button onclick="toggle_search_form()" class="dropbtn"><img id="addHouse" src="../images/addHouse.png" /></button>
            <div id="search_form" class="dropdown-content">
                <form id="form" action="../actions/action_search.php" method="post">
                    <label>Where:<input id="location" type="text" name="location"/></label>
                    <label>Check in:<input id="stay_begin" type="date" name="check_in"/></label>
                    <label>Check out:<input id="stay_end" type="date" name="check_out"/></label>
                    <label>Guests:<input id="guests" type="number" min= "1" name="guests" value="1" required/></label>
                    <label>Budget: <span id = "budget_value"></span><input type="range" min="1" max="500" class="budget_slider" id="budget_slider" name="budget"></label>
                <input id="submit_btn" type="submit" name="search" value="Search"/>
                </form>
            </div>
        </div>

        <div id="login_modal" class="modal">
            <div class="modal-content animate">
                <form id="login_form" action="src/actions/action_login.php" method="post">
                    <div id="input-div">
                        <label> Username <input type="text" name="username" required> </label>
                        <label> Password <input type="password" name="password" required> </label>
                        <button type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="register_modal" class="modal">
            <div class="modal-content animate">
                <form id="register_form" action="src/actions/action_register.php" method="post" enctype="multipart/form-data">
                    <div id="input-div">
                        <label> Username <input type="text" name="username" required> </label>
                        <label> Name <input type="text" name="name" required> </label>
                        <label> Email <input type="text" name="email" required> </label>
                        <label> Birthday <input type="date" name="birthday" required> </label>
                        <label> Nationality <input type="text" name="nationality" required> </label>
                        <label> Password <input type="password" name="password" required> </label>
                        <label> Profile Image <input type="file" name="profile_img" id="profile_img"> </label>
                        <button type="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="addHouse">
          <a href="add_story.php">
            <img id="addHouse" src="../images/addHouse.png" />
          </a>
        </div>
        <?php
          if (isset($_SESSION['username'])) {
            $user = get_user_info($_SESSION['username']);
            $image_url = get_image_url($user['profile_image']);
            ?>
          <a href="profile.php?username=<?= $_SESSION['username'] ?>">
            <img id="profilePic" src="../images/<?= $image_url ?>" />
          </a>
          <a href="src/actions/action_log_out.php" id="logOut">Log Out</a>
        <?php
          } else {
            ?>
          <button class = "top_bar_btn"onclick="document.getElementById('register_modal').style.display='block'">Register| </button>
          <!--<a id="Log In" href="src/pages/login.php">Log In</a>-->
          <button class = "top_bar_btn"onclick="document.getElementById('login_modal').style.display='block'">Login</button>
          <?php
          }
          /*if (isset($_SESSION['message'])) {
            print_r($_SESSION['message']);
          }*/
          ?>
      </div>
    <?php } ?>

    <?php function draw_footer()
    { ?>
    </div>
  </body>

  </html>
<?php } ?>