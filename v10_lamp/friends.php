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
    // display friends list
    echo '<div class="container-fluid">';
    echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
    echo '<div class="container_title"><h3>Friends </h3></div>';
    // create a table with current friends
    echo '<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">Friend Level</th>
        <th scope="col"  colspan="2">Set Friend Level</th>
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
                echo '<td><a href="include/script_manage_friend.php?otherUser=' .$row["otherUser"].'&currentUser=' .$row["currentUser"].'&level=1&row=' .$row["id"].'"> Friend</a></td>';
                echo '<td><a href="include/script_manage_friend.php?otherUser=' .$row["otherUser"].'&currentUser=' .$row["currentUser"].'&level=2&row=' .$row["id"].'"> Best Friend </a></td>';
                echo '<td><a href="include/script_remove_friend.php?otherUser=' .$row["otherUser"].'"> remove</a></td>';
                echo '</tr>';
                $friends_row_num = $friends_row_num+1;
            }
        }
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    //end friends list section
  } 
      
  // display current friend requests
  echo '<div class="container-fluid">';
  echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
  echo '<div class="container_title"><h3>Received Requests </h3></div>';

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
  echo '</div>';
  echo '</div>';
  //end display friend request section

  // sent requests
  echo '<div class="container-fluid">';
  echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
  echo '<div class="container_title"><h3>Sent Requests </h3></div>';

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
  echo '</div>';
  echo '</div>';
  //end sent requests section

  echo '</div>'; //closes main_container
?>            

<?php
  include 'right_bar.php';
  include_once 'footer.php';
?>