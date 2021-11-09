<?php
  session_start();
?>

<?php

if (isset($_SESSION["userName"])){

    require_once 'script_db_connection.php';
    require_once 'script_functions.php';
    
    $currentUser = $_SESSION["userName"];
    $otherUser = $_GET['otherUser'];

    echo $currentUser;
    echo $otherUser;


    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // check friendship status
    $isCurrentFriend = false;

    $queryRelationship = "SELECT * FROM relationship_table WHERE currentUser='$currentUser' AND otherUser='$otherUser'";
    // if results
    if ($resultRelationship = $conn->query($queryRelationship)) {
        $rowRelationship = $resultRelationship->fetch_assoc();
        if($rowRelationship["relationship_level"] >= 1){
            $isCurrentFriend = true;
        }
    }
    
    // if not friends add request
    if($isCurrentFriend != true){
        $sql = "INSERT INTO relationship_table (currentUser, otherUser, request_status)
                VALUES ('$currentUser', '$otherUser', 0), 
                       ('$otherUser', '$currentUser', -1)";
    
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
