<?php
  include_once 'header.php';
?>

<?php
  // if there is a current session
  if (isset($_SESSION["userName"])){
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    $base_friend_level = 1;
    $best_friend_level = 2;
    $reject_friendship = 3;

    // display personal profile
    // select all from table relay_user
    $query = "SELECT * FROM relay_user";
    // if results
    if ($result = $conn->query($query)) {
        // loop thru each row of table
        while ($row = $result->fetch_assoc()) {
          // if current session matches user in relay_user print profile
          if($_SESSION["userName"] == $row["userName"] ){
           echo '<div class="container-fluid">';
           echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
           echo '<div class="container title"><h3>personal profile</h3></div>';
           echo '<div class="container content">';
           echo '<p class="main">User Name: ' . $row["userName"] . '</p>'; 
           echo '<p class="main">First Name: ' . $row["firstName"] . '</p>'; 
           echo '<p class="main">Last Name: ' . $row["lastName"] . '</p>'; ;
           echo '<p class="main">Email: ' . $row["email"] . '</p>'; 
           echo '<p class="main">Bio: ' . $row["bio"] . '</p>'; 
           echo '<br>  ';
           echo '</div>';
           echo '<div class="container footer"><p class="footer">.</p></div>';
           echo '</div>';
          }
        }
      }

      // display friends list
      echo '<div class="container-fluid">';
      echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
      echo '<div class="container title"><h3>friends </h3></div>';

      $query = "SELECT * FROM friendships";

      $display_friendship_level;

      if ($result = $conn->query($query)) {
      
          while ($row = $result->fetch_assoc()) {
            
            if($row["friend_level"] == 1){
              $display_friendship_level = "friend";
            }
            else if($row["friend_level"] == 2){
              $display_friendship_level = " best friend";
            }
            else if($row["friend_level"] == 3){
              $display_friendship_level = "rejected";
            }

            if($_SESSION["userName"] == $row["user1"]){

              echo '<div class="container content">';
              echo '<a href="user_profile.php?usrName='.$row["user2"].'">'; echo $row["user2"]; echo '</a>'; echo " // "; echo $display_friendship_level;
              echo '<br>';
              echo '<br>';
              echo '</div>';

           }
          }
      }       
      echo '<div class="container footer"><p class="footer">.</p></div>';
      echo '</div>';
      echo '</div>';
      

      // display current friend requests
      echo '<div class="container-fluid">';
      echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
      echo '<div class="container title"><h3>current friend requests </h3></div>';

      $query = "SELECT * FROM friend_request";

      if ($result = $conn->query($query)) {
      
          while ($row = $result->fetch_assoc()) {
          
            if($_SESSION["userName"] == $row["currentUser"]){

              echo '<div class="container content">';
              echo '<a href="user_profile.php?usrName='.$row["friend_request_name"].'">'; echo $row["friend_request_name"]; echo '</a>'; echo " // ";
              echo '<a href="include/script_approve_requests.php?friend_request_name='.$row["friend_request_name"].'&approval='.$base_friend_level.'">'; echo 'approve as friend'; echo '</a>'; echo " // ";
              echo '<a href="include/script_approve_requests.php?friend_request_name='.$row["friend_request_name"].'&approval='.$best_friend_level.'">'; echo 'approve as best friend'; echo '</a>'; echo " // ";
              echo '<a href="include/script_approve_requests.php?friend_request_name='.$row["friend_request_name"].'&approval='.$reject_friendship.'">'; echo 'reject friendship'; echo '</a>'; echo " // ";

              echo '<br>';
              echo '<br>';
              echo '</div>';

           }
          }
      }       
      echo '<div class="container footer"><p class="footer">.</p></div>';
      echo '</div>';
      echo '</div>';
      


      // display personal posts
      $query = "SELECT * FROM posts";

      if ($result = $conn->query($query)) {
      
          while ($row = $result->fetch_assoc()) {
          
            if($_SESSION["userName"] == $row["usrName"]){
              echo '<div class="container-fluid">';
              echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
              echo '<div class="container title"><h3>';  echo $row["usrName"]; echo " // "; echo $row["title"]; echo '</h3></div>';
              echo '<div class="container content">';
              echo $row["content"]; 
              echo '<br>';
              echo '<br>';
              echo '</div>';
              echo '<div class="container footer"><p class="footer">.</p></div>';
              echo '</div>';
              echo '</div>';
           }
          }
      }       
  
  
  
    }

  // return to index if no current session
  else{
    header("location: index.php");
  }
?>            

<?php
  include_once 'footer.php';
?>