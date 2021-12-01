<?php
  session_start();
?>

<?php
 if (isset($_SESSION["userName"])){
   
    require_once 'script_db_connection.php';
    require_once 'script_functions.php';


      $pid = $_GET['id'];
      $comment = $_GET['comment'];
      $comment_date = $_GET['date'];
      $comment_by = $_SESSION["userName"];

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      
      // update friend request table
      $query = "SELECT * FROM posts";
      if ($result = $conn->query($query)) {
        $sql = "UPDATE posts SET comment = $comment comment_by = $user comment_date = $comment_date WHERE id = $pid";
      }
      
      if ($conn->query($sql) === TRUE) {
        header("location: ../index.php?comment=added");
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