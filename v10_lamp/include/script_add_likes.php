<?php
  session_start();
?>



<?php
 if (isset($_SESSION["userName"])){
    require_once 'script_db_connection.php';
    require_once 'script_functions.php';


      $pid = $_GET['id'];
      $current_num_likes = $_GET['likes'];
      
      $new_num_likes = $current_num_likes + 1;

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      
      // update friend request table
      $query = "SELECT * FROM posts";
      if ($result = $conn->query($query)) {
        $sql = "UPDATE posts SET likes = $new_num_likes WHERE id = $pid";
      }
      
      if ($conn->query($sql) === TRUE) {
        header("location: ../index.php?liked=added");
      } 
    
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
     }
    

$conn->close();

  }

  else{
    header("location: ../login.php");
  }


?>