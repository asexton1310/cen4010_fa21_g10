<?php
  session_start();
?>


<?php
    // this section updates timestamps to track that the current user is online
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';
    
    if (isset($_SESSION["userName"])) {
        $userName = $_SESSION["userName"];
        $query = "UPDATE online_users SET lastonline = CURRENT_TIMESTAMP WHERE userName = '$userName'";

        if ($result = $conn->query($query)) {
            //echo "updated online_users";
        }
        else {
            $query = "INSERT INTO online_users (userName)
                        VALUES ('$userName')";

            if ($result = $conn->query($query)) {
                echo "inserted online_users";
            }
        }
    }
?>



<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>RELAY</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
 
  <link rel="stylesheet" href="css/stylesheet.css">   

  <!-- search button icon -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
</head>
<body id = "body">
  <div class="header">
    <div class="header_left"> 
      <a class="navbar-brand" href="index.php">RELAY</a>
      <div class = "">
        <form id="search" action="returned_search.php" method="post">
          <select name="results">
            <option value="user">User</option>
            <option value="post">Post</option>
          </select>
          <input type="text" placeholder="Search Relay" name="search" type="search" required>
          <button type="submit" name="submit">Submit</button>
        </form>
        </div>
      </div>
      <!-- middle side of nav bar -->
      <?php if (isset($_SESSION["userName"])){ ?>
        <div class = "header_middle_in" id= header_middle_in>
          <a class="header_option <?php echo ($_SERVER['PHP_SELF'] == "/index.php" ? "active" :"");?>" href='index.php'>
            <span style= "display: block;" class='nav_item'>Community</span>
          </a>
          <a class="header_option <?php echo ($_SERVER['PHP_SELF'] == "/feed.php" ? "active" :"");?>" href='feed.php'>
            <span style= "display: block;" class='nav_item'>Feed</span>
          </a>
          <a class="header_option <?php echo ($_SERVER['PHP_SELF'] == "/post.php" ? "active" :"");?>" href='post.php'>
            <span style= "display: block;" class='nav_item'>Post</span>
          </a>
          <a class="header_option <?php echo ($_SERVER['PHP_SELF'] == "/chat.php" ? "active" :"");?>" href='chat.php'>
            <span style= "display: block;" class='nav_item'>Chat</span>
          </a> 
          </div>
      <?php } else { ?>
        <div class = "header_middle_in">
          <a class="header_option active" href='feed.php'>
            <span style= "display: block;" class='nav_item'>Community</span>
          </a>
          <a class="header_option" href='login.php'>
            <span style= "display: block;" class='nav_item'>Login</span>
          </a> 
          <a class="header_option" href='register.php'>
            <span style= "display: block;" class='nav_item'>Register</span>
          </a>
          </div>
        <?php } ?> 
        <!-- right side of nav bar -->
        <?php if (isset($_SESSION["userName"])){ ?>
          <div class = "header_right_in">
            <div class="notif">
              <span class="material-icons">notifications</span>
            </div>
            <a class="log_out" href='include/script_logout.php'>
              <span class="material-icons">logout</span>
            </a>
          </div>
          <?php } else { ?>
            <div class = "header_right_in">

            </div>
          <?php } ?>
          <!--for the toggle nav bar. starts off hidden-->
          <input type="checkbox" id = "check">
    <label for="check" class = "checkbtn">
      <span class="material-icons">menu</span>
    </label>
    <ul class="navbar_ul">
      <li class="navbar_item">
        <a class="navbar_link" id="home" href="index.php">community</a>
      </li>
      <?php
      if (isset($_SESSION["userName"])){
        echo "<li class='navbar_item'> <a class='navbar_link' id='chat' href='feed.php'>feed</a> </li>";
        echo "<li class='navbar_item'><a class='navbar_link' id='post' href='post.php'>post</a></li>";
        echo "<li class='navbar_item'> <a class='navbar_link' id='chat' href='chat.php'>chat</a> </li>";
        echo "<li class='navbar_item'> <a class='navbar_link' id='profile' href='profile.php'>profile</a> </li>";
        echo "<li class='navbar_item'> <a class='navbar_link' id='profile' href='include/script_logout.php'>logout</a> </li>";
      }
      else{
        echo "<li class='navbar_item'><a class='navbar_link' id='post' href='post.php'>post</a></li>";
        echo "<li class='navbar_item'><a class='navbar_link' id='logi' href='login.php'>login</a></li>";
        echo "<li class='navbar_item'><a class='navbar_link' id='register' href='register.php'>register</a></li>";
      }
      ?>
    </ul>
      <!--Header class Ends-->
    </div>
  <div class="main_body"> <!--body starts-->
    <?php if (isset($_SESSION["userName"])){ ?>
      <div class="left_side_bar_in" ><!--left sidebar active due to user login starts-->
        <a class="left_sidebar_row" href='profile.php'>
        <img class = "profile_img"
          src=".\my_profile_placeholder.jpg"
          alt=""          
          />
          <h6><?php echo $_SESSION["userName"]?></h6>
      </a>
        <div class="left_sidebar_in">
        <a class="left_sidebar_row" href='friends.php'>
          <span class="material-icons">people</span>
          <h6>All Friends</h6>
    </a>
        </div>
        <div class="left_sidebar_row">
          <span class="material-icons">forum </span>
          <h6>Active Chats</h6>
        </div>
      </div><!--left sidebar active class ends ends-->
    <?php } else { ?>
      <div class="left_side_bar_in" style = "visibility: hidden;"><!--left sidebar is hidden because user is not logged in but shape remains-->
        <a class="left_sidebar_row" href='profile.php'>
        <img class = "profile_img"
          src=".\my_profile_placeholder.jpg"
          alt=""          
          />
          <h6>username?></h6>
      </a>
        <div class="left_sidebar_row" >
          <span class="material-icons">people</span>
          <h6>All Friends</h6>
        </div>
        <div class="left_sidebar_row">
          <span class="material-icons">forum </span>
          <h6>Live Chats</h6>
        </div>
      </div><!--left sidebar class ends ends-->
    <?php } ?>

<!--main body continues on to the other php files up until footer-->
    