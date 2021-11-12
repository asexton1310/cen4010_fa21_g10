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
        <input type="submit" value="edit">
        </form>';
        echo '<br>  ';
        echo '</div>';
    }
  } 
      
  // display current friend requests
 
  //end display friend request section

  // sent requests

  //end sent requests section

  echo '</div>';
  echo '</div>';



  // display personal posts
  $query = "SELECT * FROM posts WHERE usrName='$currentUser'";

  if ($result = $conn->query($query)) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="container-fluid">';
        echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
        echo '<div class="container title"><h3>';  echo $row["usrName"]; echo " // "; echo $row["title"]; echo '</h3></div>';
        echo '<div class="container content">';
        echo $row["content"]; 
        echo '<br>';
        if ($row["image"]){
      ?>
     <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style='height: 100%; width: 100%; object-fit: cover' /> 
      <?php }
        echo '<br>';
        echo '<br>';
        echo '</div>';
        echo '<div class="container footer"><p class="footer"></p></div>';
        echo '</div>';
        echo '</div>';
     }
    }
    
  // return to index if no current session
  else{
    header("location: login.php");
  }
  echo '</div>';

  include 'right_bar.php';


?>       
     

<?php

  include_once 'footer.php';
?>