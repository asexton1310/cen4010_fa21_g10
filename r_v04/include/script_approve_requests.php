<?php
  session_start();
?>

<?php
    require_once 'script_db_connection.php';
    require_once 'script_functions.php';

      $user1 = $_SESSION["userName"];
      $user2 = $_GET['friend_request_name'];
      $friend_level = $_GET['approval'];
      $friendship_request_id;
      
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      
      // update friend request table
      $query = "SELECT * FROM friend_request";
      if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            if ($user1 == $row['currentUser'] && $user2 == $row['friend_request_name']){
              
             // set current request to 0
             $friendship_request_id = $row['id'];
             $sql = "UPDATE friend_request SET current_request = 0 WHERE id = $friendship_request_id";
              if($conn->query($sql) === true){
                echo "Records was updated successfully.";
              } 
              else{
                echo "ERROR: Could not able to execute $sql. " 
                . $mysqli->error;
            }
            // set completed request to 1
            $sql = "UPDATE friend_request SET completed_requests = 1 WHERE id = $friendship_request_id";
            if($conn->query($sql) === true){
              echo "Records was updated successfully.";
            } 
            else{
              echo "ERROR: Could not able to execute $sql. " 
              . $mysqli->error;
          }

          }
        
        }
    }

      // add to friend and set friend level if approved
      if($friend_level == 1 || $friend_level == 2){
              $sql = "INSERT INTO friendships (user1, user2, friend_level)
      VALUES ('$user1', '$user2', '$friend_level')";
      if($conn->query($sql) === true){
        header("location: ../profile.php");
       } 
      }

?>