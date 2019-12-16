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
    <link href="../css/search_results.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <script src="../javascript/topBar.js" defer></script>
    <script src="../javascript/home.js" defer></script>
    <script src="../javascript/profile.js" defer></script>
    <script src="../javascript/house.js" defer></script>

</head>
  <body>
      <div id="login_modal" class="modal">
            <div class="modal-content animate">
                <form id="login_form" action="../actions/action_login.php" method="post">
                    <div class="input-div">
                        <label> Username <input type="text" name="username" required> </label>
                        <label> Password <input type="password" name="password" required> </label>
                        <button type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="register_modal" class="modal">
            <div class="modal-content animate">
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
    <div id="all">
      <div id="topBar">
        <a href="home.php">
          <img id="logo" src="../../images/houseLogo.png" />
        </a>
        <div id="searchBar">
          <input id="searchField" type="text" placeholder="Enter a location..">
          <button id="searchButton" type="submit" onclick=""><i class="fa fa-search fa-2x"></i></button>
        </div>
        <div id="addHouse">
          <a id="addHouseLink" href="add_story.php">
            <img id="addHouseImg" src="../../images/addHouse.png" />
          </a>
        </div>
        <?php
          if (isset($_SESSION['username'])) {
            $user = get_user_info($_SESSION['username']);
            $image_url = get_image_url($user['profile_image']);
            echo '<script type="text/javascript">','document.getElementById("addHouseLink").style.display="block"','</script>';
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
            <div id="dropdown">
                  <div id="search_form" class="dropdown-content noShow">
                      <form id="form" action="../actions/action_search.php" method="post">
                        <div>
                            <label> Check-In: </label><input id="stay_begin" type="date" name="check_in"/>
                            <label> Check-Out: </label><input id="stay_end" type="date" name="check_out"/>
                        </div>
                        <div>
                            <br/>
                            <label class="centerLabel"> Guests: </label>
                            <input id="guests" type="number" min= "1" name="guests" value="1" required/>
                        </div>
                        <div>
                            <br/><?php
                            $max_budget = get_most_expensive_house();
                            ?>
                            <label class="centerLabel"> Budget: </label><span id = "budget_value"></span><input type="range" min="1" max="<?=$max_budget['max_budget']?>" class="budget_slider" id="budget_slider" name="budget">
                        </div>
                        <button id="closeExtraOption" type="button" name="close"><i class="fa fa-times-circle fa-5x"></i></button>
                      </form>
                  </div>
            </div>

    <?php }

    function draw_messages()
    {
      if (isset($_SESSION['messages'])) { ?>
        <section id="messages">
           <?php foreach ($_SESSION['messages'] as $message) { ?>
              <div class="<?= $message['type'] ?>"><?= $message['content'] ?></div>
           <?php } ?>
        </section>
     <?php unset($_SESSION['messages']);
        }
    }
    function draw_footer()
    { ?>
    </div>
  </body>

  </html>
<?php } ?>