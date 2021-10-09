

<?php

    require_once 'script_db_connection.php';
    require_once 'script_functions.php';

      $user1 = $_SESSION["userName"];
      $user2 = $_GET['friend_request_name'];
      $friend_level = $_GET['approval'];

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      
      $sql = "INSERT INTO friendships (user1, user2, friend_level)
      VALUES ('$user1', '$user2', '$friend_level')";
      
      $friendship_request_id;



      $query = "SELECT * FROM friend_request";
      if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            if ($user1 == $row['currentUser'] && $user2 == $row['friend_request_name']){
                $friendship_request_id =  $row['id'];
     //           $sql = "UPDATE friend_request SET current_request = 0 WHERE id= '$row['id']'";
     //           $sql = "UPDATE friend_request SET completed_request = 1 WHERE id='$row['id']'";
            }
        
        }
    }


  //    $sql = "UPDATE friend_request SET current_request = 0 WHERE id= '$friendship_request_id'";
  //    $sql = "UPDATE friend_request SET completed_request = 1 WHERE id='$friendship_request_id'";
      

?>