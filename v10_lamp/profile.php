<?php
  include_once 'header.php';
?>

<?php
  // Create a friends.php to have a manage friends
  // if there is a current session
  if (isset($_SESSION["userName"])){
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    $currentUser = $_SESSION["userName"];

    $base_friend_level = 1;
    $best_friend_level = 2;
    $reject_friendship = 3; //should do delete instead of updating

    // display personal profile
    // select all from table relay_user
    $query = "SELECT * FROM relay_user WHERE userName='$currentUser'";
    echo '<div class="main_container">';
    // if results
    if ($result = $conn->query($query)) {

        $row = $result->fetch_assoc();
        echo '<div class="container-fluid">';
        echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
        echo '<div class="container_title"><h3>Personal Profile</h3></div>';
        echo '<div class="container content" id = "container_content">';
        echo '<p class="main">User Name: ' . $row["userName"] . '</p>'; 
        echo '<p class="main">First Name: ' . $row["firstName"] . '</p>'; 
        echo '<p class="main">Last Name: ' . $row["lastName"] . '</p>'; ;
        echo '<p class="main">Email: ' . $row["email"] . '</p>'; 
        echo '<p class="main">Bio: ' . $row["bio"] . '</p>'; 
        echo'<form action="edit.php" method="post">
        <input type="submit" value="Edit">
        </form>';
        echo '<br>  ';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
  } 

  // display personal posts
  $query = "SELECT * FROM posts WHERE usrName='$currentUser'";

  if ($result = $conn->query($query)) {
      while ($row = $result->fetch_assoc()) {
        ?>
        <div class="post_container bg-white"><!--post with like and comment active due to user login starts-->
            <div class="post_top">
                <img class = "profile_img post_profile_pic"
                            src="my_profile_placeholder.jpg"
                            alt=""          
                        />
                <div class = "post_info">
                    <h6><?php echo '<a href="user_profile.php?usrName='.$row["usrName"].'">'; echo $row["usrName"]; echo '</a>';?></h6>
                    <p> <?php echo $row["postDate"]?></p>
                </div>
            </div>
            <div class="post_content">
                    <h3 class = "post_title"><?php echo '<a href="expandpost.php?id='.$row["id"].'">'.$row["title"].'</a>'?></h3>
                    <p class="post teaser"><?php echo $row["teaser"]?></p>
            </div>
            <div class="postimg">
                    <img class = "post_img" onerror='this.style.display = "none"'
                    src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style='height: 100%; width: 100%; object-fit: cover'
                        alt=""          
                    />
            </div>
            <div class="post_totals">
                    <p><?php echo $row["likes"]?> Likes</p>
                    <p>comment count</p>
                    <p>shares count</p>
            </div>
            <div class="post_interact">
                    <?php
                    echo '<a class = "interaction_option" href="include/script_add_likes.php?id='.$row["id"].'&likes='.$row["likes"].'">';
                    echo '                  <span style="display: block;" class="material-icons">favorite_border</span>  </a> ';
                    ?> 
                    <span class="material-icons">chat_bubble_outline</span>
                    <span class="material-icons">ios_share</span>
            </div>
        </div>
        <?php
     }
    }
    
  // return to login if no current session
  else{
    header("location: login.php");
  }
  echo '</div>'; // close main_container div

  include 'right_bar.php';
?>           

<?php
  include_once 'footer.php';
?>