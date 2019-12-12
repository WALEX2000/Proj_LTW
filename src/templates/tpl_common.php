<?php
include_once('../includes/session.php');
include_once('../database/profile_queries.php');
include_once('../database/image_queries.php');
include_once('../templates/tpl_authentication.php');


function draw_header($stylesheet)
{ ?>
  <!DOCTYPE html>
  <html lang="en-US">

  <head>
    <meta charset="UTF-8">
    <title>Homie</title>
    <link href="../css/<?= $stylesheet ?>" rel="stylesheet" />
    <link href="../css/topBar.css" rel="stylesheet" />
    <link href="../css/story.css" rel="stylesheet" />
    <link href="../css/search_results.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <script src="../javascript/topBar.js" defer></script>
    <script src="../javascript/home.js" defer></script>

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
          <img id="logo" src="../../images/houseLogo.png" />
        </a>
        <div id="searchBar">
          <input id="searchField" type="text" placeholder="Enter a location..">
          <button id="searchButton" type="submit" onclick=""><i class="fa fa-search fa-2x"></i></button>
        </div>
        <div id="login_modal" class="modal">
            <div class="modal-content animate">
                <form id="login_form" action="../actions/action_login.php" method="post">
                    <div id="input-div">
                        <label> Username <input type="text" name="username" required> </label>
                        <label> Password <input type="password" name="password" required> </label>
                        <button type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>


        <?php
          draw_login();
          draw_register();
          unset($_SESSION['messages']);
          ?>
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
          <button class = "top_bar_btn"onclick="document.getElementById('register_modal').style.display='block'">Register</button>
          <!--<a id="Log In" href="../pages/login.php">Log In</a>-->
          <button class="top_bar_btn" onclick="document.getElementById('login_modal').style.display='block'">Login</button>
        <?php
          }
          /*if (isset($_SESSION['message'])) {
            print_r($_SESSION['message']);
          }*/
          ?>
      </div>
            <div class="dropdown dropdownAnimation">
                  <div id="search_form" class="dropdown-content">
                      <form id="form" action="../actions/action_search.php" method="post">
                        <div>
                            <label> Check-In: </label><input id="stay_begin" type="date" name="check_in"/>
                            <label> Check-Out: </label><input id="stay_end" type="date" name="check_out"/>
                        </div>
                        <div>
                            <br/>
                            <label> Guests: </label>
                            <input id="guests" type="number" min= "1" name="guests" value="1" required/>
                        </div>
                        <div>
                            <br/>
                            <label> Budget: </label><span id = "budget_value"></span><input type="range" min="1" max="500" class="budget_slider" id="budget_slider" name="budget">
                        </div>
                        <button id="closeExtraOption" type="button" name="close"><i class="fa fa-times-circle fa-5x"></i></button>
                      </form>
                  </div>
            </div>

    <?php } ?>

    function draw_message($message)//TODO: Good or bad
    {
      ?>
      <div id="message_modal" class="modal">
        <div class="modal-content animate">
          <h1><?=$message?></h1>
          <a href="../pages/<?=$_SESSION['last_page']?>" onclick="document.getElementById('message_modal').style.display='none'">Ok</a>
        </div>
      </div>
    <?php
    }
    function draw_footer()
    { ?>
    </div>
  </body>

  </html>
<?php } ?>