<?php
  session_start();
?>

<?php
    require_once 'script_db_connection.php';
    require_once 'script_functions.php';

      $currentUser = $_SESSION["userName"];
      $requestor_name = $_GET['requestor_name'];
      $relationship_level = $_GET['level'];
      $id = $_GET['row'];

     // echo $requestor_name;
     // echo $relationship_level;
      echo $id;



        $sql = "UPDATE relationship_table SET request_status = 1 WHERE id=$id";
  
      
        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }
        
        $sql = "UPDATE relationship_table SET relationship_level = '$relationship_level' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }

        header("location:  ../profile.php");



        $conn->close();


?>


