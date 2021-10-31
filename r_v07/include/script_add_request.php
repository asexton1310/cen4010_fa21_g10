<?php
  session_start();
?>

<?php

if (isset($_SESSION["userName"])){

    require_once 'script_db_connection.php';
    require_once 'script_functions.php';
    
    $currentUser = $_SESSION["userName"];
    $requestor_name = $_GET['requestor_name'];

    echo $currentUser;
    echo $requestor_name;


    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

        // check friendship status
        $isCurrentFriend = false;
    
        $queryRelationship = "SELECT * FROM relationship_table";
        // if results
        if ($resultRelationship = $conn->query($queryRelationship)) {
          // loop thru each row of table
          while ($rowRelationship = $resultRelationship->fetch_assoc()) {
            if($currentUser ==$rowRelationship["currentUser"] && $requestor_name == $rowRelationship["requestor_name"] &&  $rowRelationship["relationship_level"] == 1){
              $isCurrentFriend = true;
            }
            else if($currentUser ==$rowRelationship["currentUser"] && $requestor_name == $rowRelationship["requestor_name"] &&  $rowRelationship["relationship_level"] == 1){
              $isCurrentFriend = true;
            }
          }
        }
    
        // if not friends add request
    if($isCurrentFriend != true){
          $sql = "INSERT INTO relationship_table (currentUser, requestor_name)
                    VALUES ('$currentUser', '$requestor_name')";
          $sql = "INSERT INTO relationship_table (requestor_name, currentUser)
                    VALUES ('$requestor_name', '$currentUser')";
        
        
                if ($conn->query($sql) === TRUE) {
                  header("location: ../index.php");
                 } 
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
              
              $conn->close();
    }

    }



    else{
    
      header("location: ../login.php");
       exit();
   }
   
