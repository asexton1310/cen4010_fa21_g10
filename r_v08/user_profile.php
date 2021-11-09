<?php
  include_once 'header.php';
?>

<?php
  // if there is a current session
  if (isset($_SESSION["userName"])){

    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    $usrName = $_GET['usrName'];
    $currentUser = $_SESSION["userName"];

    // check friendship status
    $isCurrentFriend = false;
    // check if friend request is pending
    $isRequestPending = false;
    $haveReceivedRequest = false;
    
    $queryRelationship = "SELECT * FROM relationship_table WHERE currentUser='$currentUser'";
    // if results
    if ($resultRelationship = $conn->query($queryRelationship)) {
      // loop thru each row of table
      while ($rowRelationship = $resultRelationship->fetch_assoc()) {
        if($usrName == $rowRelationship["otherUser"] &&  $rowRelationship["relationship_level"] >= 1){
          $isCurrentFriend = true;
        }
        else if($usrName == $rowRelationship["otherUser"] &&  $rowRelationship["request_status"] == 0){
            $isRequestPending = true;
        }
        else if($usrName == $rowRelationship["otherUser"] &&  $rowRelationship["request_status"] == -1){
            $haveReceivedRequest = true;
        }
      }
    }

    $query = "SELECT * FROM relay_user WHERE username='$usrName'";
    
    // if results
    if ($result = $conn->query($query)) { 
        $row = $result->fetch_assoc();    
        echo '<div class="container-fluid">';
        echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
        echo '<div class="container title"><h3>user profile</h3></div>';  

        echo '<div class="container content">';
        echo '<p class="main">User Name: ' . $row["userName"] . '</p>'; 
        echo '<p class="main">First Name: ' . $row["firstName"] . '</p>'; 
        echo '<p class="main">Last Name: ' . $row["lastName"] . '</p>'; ;
        echo '<p class="main">Bio: ' . $row["bio"] . '</p>'; 
        echo '<br>  ';
        echo '</div>';
        echo '<div class="container content">';
        if($isCurrentFriend == false && $isRequestPending == false && $haveReceivedRequest == false){
            echo '<a href="include/script_add_request.php?otherUser='.$row["userName"].'">'; echo " request friendship"; echo '</a>';
        }
        else if($isCurrentFriend){
            echo '<a href="include/script_remove_friend.php?otherUser='.$row["userName"].'">'; echo " remove friend"; echo '</a>';
        }
        else if($isRequestPending){
            echo " request sent";
        }
        else if($haveReceivedRequest){
            echo " user has sent you a friend request, ";
            echo '<a href="profile.php">'; echo " go to your profile"; echo '</a>';
        }
        echo '</div>';
        echo '<div class="container footer"><p class="footer">.</p></div>';
        echo '</div>';
    }
  

    $query = "SELECT * FROM posts WHERE usrname='$usrName' AND postLevel=0";

    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="container-fluid">';
            echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
            echo '<div class="container title"><h3>'; echo $row["usrName"]; echo " // "; echo $row["title"];  echo " // "; echo $row["postDate"]; echo '</h3></div>';
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

      $query = "SELECT posts.usrName, posts.title, posts.content, posts.image, posts.postLevel, posts.postDate, posts.id, posts.likes, relationship_table.otherUser, relationship_table.currentUser, relationship_table.relationship_level  from posts, relationship_table where posts.postLevel = relationship_table.relationship_level";

      if ($result = $conn->query($query)) {
    
        while ($row = $result->fetch_assoc()) {
            
            $posterUserName = $row['usrName'];
            $friendName = $row['otherUser'];
            $friendName2 = $row['currentUser'];

            $relationship_level = $row['relationship_level'];
            $post_level = $row['postLevel'];

         //   echo "$relationship_level - $post_level <br />";
            //$_SESSION["userName"]
            if($post_level >= 1){
                if(($posterUserName == $friendName || $posterUserName == $friendName2) && $_SESSION["userName"] != $posterUserName && ($_SESSION["userName"] == $friendName || $_SESSION["userName"] == $friendName2)){
                    echo '<div class="container-fluid">';
                    echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
                    echo '<div class="container title"><h3>'; echo '<a href="user_profile.php?usrName='.$row["usrName"].'">'; echo $row["usrName"]; echo '</a>'; echo " // "; echo $row["title"];  echo " // "; echo $row["postDate"]; echo '</h3></div>';
                    echo '<div class="container content">';
                    echo $row["content"]; 
                    echo '<br>';
                    echo '<br>';
                    if ($row["image"]){
                  ?>
                 <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style='height: 100%; width: 100%; object-fit: cover' /> 
                  <?php }
                    echo '<br>';
                    echo '</div>';
                    echo '<div class="container footer"><p class="footer">'; echo '<a href="include/script_add_likes.php?id='.$row["id"].'&likes='.$row["likes"].'">'; echo 'like  </a> // '; echo $row["likes"]; echo '</p></div>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        }
    }  
  
  
  
  
  
  
  
  
  } // end if

  // return to index if no current session
  else{
    header("location: login.php");
  }
?>            

<?php
  include_once 'footer.php';
?>