<?php
  include_once 'header.php';
?>

<?php
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
    // if results
    if ($result = $conn->query($query)) {
        $row = $result->fetch_assoc();
        echo '<div class="container-fluid">';
        echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
        echo '<div class="container title"><h3>personal profile</h3></div>';
        echo '<div class="container content">';
        echo '<p class="main">User Name: ' . $row["userName"] . '</p>'; 
        echo '<p class="main">First Name: ' . $row["firstName"] . '</p>'; 
        echo '<p class="main">Last Name: ' . $row["lastName"] . '</p>'; ;
        echo '<p class="main">Email: ' . $row["email"] . '</p>'; 
        echo '<p class="main">Bio: ' . $row["bio"] . '</p>'; 
        echo'<form action="edit.php" method="post">
        <input type="submit" value="edit">
        </form>';
        echo '<br>  ';
        echo '<div class="container footer"><p class="footer">.</p></div>';
        echo '</div>';
    }
    //end personal profile section

    // display friends list
    echo '<div class="container-fluid">';
    echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
    echo '<div class="container title"><h3>friends </h3></div>';
    // create a table with current friends
    echo '<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">Friend Level</th>
        <th scope="col">Unfriend</th>
    </tr>
    </thead>
    <tbody>';
    $query = "SELECT * FROM relationship_table WHERE currentUser='$currentUser'";
    $friends_row_num = 1;
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            if($row["relationship_level"] == 1 || $row["relationship_level"] == 2){
                echo '<tr>';
                echo '<th scope="row">' .$friends_row_num.' </th>';
                echo '<td><a href="user_profile.php?usrName=' .$row["otherUser"].'"> '.$row["otherUser"]. '</a></td>';
                if($row["relationship_level"] == 2) {
                    echo '<td> Best Friend </td>';
                }
                else {
                    echo '<td> Friend </td>';
                }
                //echo '<td> '.$row["relationship_level"]. ' </td>';
                echo '<td><a href="include/script_remove_friend.php?otherUser=' .$row["otherUser"].'"> remove</a></td>';
                echo '</tr>';
                $friends_row_num = $friends_row_num+1;
            }
        }
    }
    echo '</tbody>';
    echo '</table>';
    //end friends list section
  } 



  echo '<div class="container footer"><p class="footer">.</p></div>';
  echo '</div>';
  echo '</div>';
      
  // display current friend requests
  echo '<div class="container-fluid">';
  echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
  echo '<div class="container title"><h3>received requests </h3></div>';

  echo '<table class="table">
  <thead>
  <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col"  colspan="2">Friend Approval Level</th>
      <th scope="col">Reject</th>
  </tr>
  </thead>
  <tbody>';
      
  $query = "SELECT * FROM relationship_table WHERE otherUser='$currentUser' AND request_status=0";
  $current_reqest_row_num = 1;
  if ($result = $conn->query($query)) {
      while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<th scope="row">' .$current_reqest_row_num. ' </th>';
          echo '<td><a href="user_profile.php?usrName=' .$row["currentUser"].'"> '.$row["currentUser"]. '</a></td>';
          echo '<td><a href="include/script_approve_requests.php?otherUser=' .$row["otherUser"].'&currentUser=' .$row["currentUser"].'&level=1&row=' .$row["id"].'"> Friend</a></td>';
          echo '<td><a href="include/script_approve_requests.php?otherUser=' .$row["otherUser"].'&currentUser=' .$row["currentUser"].'&level=2&row=' .$row["id"].'"> Best Friend </a></td>';
          echo '<td><a href="include/script_remove_friend.php?otherUser=' .$row["currentUser"].'"> Reject</a></td>';
          echo '</tr>';
          $current_reqest_row_num = $current_reqest_row_num+1; 
      }
  } 
  echo '</tbody>';
  echo '</table>';
  //end display friend request section

  echo '<div class="container footer"><p class="footer">.</p></div>';
  echo '</div>';
  echo '</div>';

  // sent requests
  echo '<div class="container-fluid">';
  echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
  echo '<div class="container title"><h3>sent requests </h3></div>';

  echo '<table class="table">
  <thead>
  <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">status</th>
  </tr>
  </thead>
  <tbody>';

  $query = "SELECT * FROM relationship_table WHERE currentUser='$currentUser' AND request_status=0";
  $current_reqest_row_num = 1;
  if ($result = $conn->query($query)) {
      while ($row = $result->fetch_assoc()) {   
          echo '<tr>';
          echo '<th scope="row">' .$current_reqest_row_num. ' </th>';
          echo '<td><a href="user_profile.php?usrName=' .$row["otherUser"].'"> '.$row["otherUser"]. '</a></td>';
          //  TODO change the below from updating relationship level to deleting rows where 
          //  currentUser='$currentUser' AND otherUser='$otherUser' and currentUser='$otherUser' AND otherUser='$currentUser'
          //  possibly add a new script_delete_friendship.php file to handle this (good idea imo)
          echo '<td>pending <a href="include/script_remove_friend.php?otherUser=' .$row["otherUser"].'"> Cancel</a></td>';
          echo '</tr>';
          $current_reqest_row_num = $current_reqest_row_num+1;
      }
  }  
  echo '</tbody>';
  echo '</table>';
  //end sent requests section

  echo '<div class="container footer"><p class="footer">.</p></div>';
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
?>            

<?php
  include_once 'footer.php';
?>