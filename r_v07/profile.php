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
      $query = "SELECT * FROM relationship_table";
      $display_friendship_level;
      $friends_row_num = 1;
      if ($result = $conn->query($query)) {
          while ($row = $result->fetch_assoc()) {
            if($row["relationship_level"] == 1 || $row["relationship_level"] == 2){
                if($_SESSION["userName"] == $row["currentUser"]){
                echo '<tr>';
                echo '<th scope="row">' .$friends_row_num.' </th>';
                echo '<td><a href="user_profile.php?usrName=' .$row["requestor_name"].'"> '.$row["requestor_name"]. '</a></td>';
                if($row["relationship_level"] == 2) {
                    echo '<td> Best Friend </td>';
                }
                else {
                    echo '<td> Friend </td>';
                }
                //echo '<td> '.$row["relationship_level"]. ' </td>';
                echo '<td><a href="include/script_approve_requests.php?requestor_name=' .$row["requestor_name"].'&level=3&row=' .$row["id"].'"> remove</a></td>';
                echo '</tr>';
              $friends_row_num = $friends_row_num+1;
              }
              else if($_SESSION["userName"] == $row["requestor_name"]){
                echo '<tr>';
                echo '<th scope="row">' .$friends_row_num.' </th>';
                echo '<td><a href="user_profile.php?usrName=' .$row["currentUser"].'"> '.$row["currentUser"]. '</a></td>';
                if($row["relationship_level"] == 2) {
                    echo '<td> Best Friend </td>';
                }
                else {
                    echo '<td> Friend </td>';
                }
                //echo '<td> '.$row["relationship_level"]. ' </td>';
                echo '<td><a href="include/script_approve_requests.php?currentUser=' .$row["currentUser"].'&level=3&row=' .$row["id"].'"> remove</a></td>';
                echo '</tr>';
              $friends_row_num = $friends_row_num+1;
              }
            }
            
           }
        }
      }   
     echo '</tbody>';
     echo '</table>';



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
      

      $query = "SELECT * FROM relationship_table";
      $current_reqest_row_num = 1;
      if ($result = $conn->query($query)) {
      
          while ($row = $result->fetch_assoc()) {
          
            if($_SESSION["userName"] == $row["requestor_name"] && $row["request_status"] == 0){

              echo '<tr>';
              echo '<th scope="row">' .$current_reqest_row_num. ' </th>';
              echo '<td><a href="user_profile.php?usrName=' .$row["currentUser"].'"> '.$row["currentUser"]. '</a></td>';
              echo '<td><a href="include/script_approve_requests.php?requestor_name=' .$row["currentUser"].'&level=1&row=' .$row["id"].'"> Friend</a></td>';
              echo '<td><a href="include/script_approve_requests.php?requestor_name=' .$row["currentUser"].'&level=2&row=' .$row["id"].'"> Best Friend </a></td>';
              echo '<td><a href="include/script_approve_requests.php?requestor_name=' .$row["currentUser"].'&level=3&row=' .$row["id"].'"> Reject</a></td>';
              echo '</tr>';
              $current_reqest_row_num = $current_reqest_row_num+1;
            }
          }
      } 
      
      echo '</tbody>';
      echo '</table>';

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
      

      $query = "SELECT * FROM relationship_table";
      $current_reqest_row_num = 1;
      if ($result = $conn->query($query)) {
      
          while ($row = $result->fetch_assoc()) {
          
            if($_SESSION["userName"] == $row["currentUser"] && $row["request_status"] == 0){

              echo '<tr>';
              echo '<th scope="row">' .$current_reqest_row_num. ' </th>';
              echo '<td><a href="user_profile.php?usrName=' .$row["requestor_name"].'"> '.$row["requestor_name"]. '</a></td>';

              echo '<td><a href="include/script_approve_requests.php?requestor_name=' .$row["requestor_name"].'&level=3&row=' .$row["id"].'"> pending</a></td>';
              echo '</tr>';
              $current_reqest_row_num = $current_reqest_row_num+1;
            }
          }
      } 
      
      echo '</tbody>';
      echo '</table>';

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
    

  // return to index if no current session
  else{
    header("location: login.php");
  }
?>            

<?php
  include_once 'footer.php';
?>