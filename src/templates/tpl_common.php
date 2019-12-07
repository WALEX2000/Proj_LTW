<?php
include_once('../includes/session.php');
include_once('../database/profile_queries.php');
include_once('../database/image_queries.php');

function draw_header($stylesheet)
{ ?>
  <!DOCTYPE html>
  <html lang="en-US">

  <head>
    <meta charset="UTF-8">
    <title>Homie</title>
    <link href="../css/<?= $stylesheet ?>" rel="stylesheet" />
    <link href="../css/topBar.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <script src="../javascript/topBar.js" defer></script>
  </head>

  <body>
    <div id="all">
      <div id="topBar">
        <a href="home.php">
          <img id="logo" src="../../images/houseLogo.png" />
        </a>
        <div id="searchBar">
          <input id="searchField" type="text" placeholder="Search..">
          <button id="searchButton" type="submit" onclick=""><i class="fa fa-search fa-2x"></i></button>
        </div>

        <div class="dropdown">
            <button onclick="toggle_search_form()" class="dropbtn"><img id="addHouse" src="../../images/addHouse.png" /></button>
            <div id="search_form" class="dropdown-content">
                <form id="form" action="../actions/action_search.php" method="post">
                    <label>Where:<input id="location" type="text" name="location"/></label>
                    <label>Check in:<input id="stay_begin" type="date" name="check_in"/></label>
                    <label>Check out:<input id="stay_end" type="date" name="check_out"/></label>
                    <label>Guests:<input id="guests" type="number" min= "1" name="guests" value="1" required/></label>
                    <input id="submit_btn" type="submit" name="search"/>
                </form>
            </div>
        </div>
        <div id="addHouse">
          <a href="add_story.php">
            <img id="addHouse" src="../../images/addHouse.png" />            
         </a>
        </div>
        <?php
          if (isset($_SESSION['username'])) {
            $user = get_user_info($_SESSION['username']);
            $image_url = get_image_url($user['profile_image']);
            ?>
          <a href="profile.php?username=<?= $_SESSION['username'] ?>">
            <img id="profilePic" src="../../images/<?= $image_url ?>" />
          </a>
          <a href="../actions/action_log_out.php" id="logOut">Log Out</a>
        <?php
          } else {
            ?>
          <a href="register.php">
            <p id="Register">Register| </p>
          </a>
          <a id="Log In" href="../pages/login.php">Log In</a>
        <?php
          }
          if (isset($_SESSION['message'])) {
            print_r($_SESSION['message']);
          }
          ?>
      </div>
    <?php } ?>

    <?php function draw_footer()
    { ?>
    </div>
  </body>

  </html>
<?php } ?>