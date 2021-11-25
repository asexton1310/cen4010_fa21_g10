<?php
  session_start();
?>

<?php
    require_once 'script_db_connection.php';
    require_once 'script_functions.php';

    $currentUser = $_GET["currentUser"];
    $otherUser = $_GET['otherUser'];
    $relationship_level = $_GET['level'];
    $id = $_GET['row'];

    // echo $otherUser;
    // echo $relationship_level;
    echo $id;

    //update the existing friend request to become a friendship
    $sql = "UPDATE relationship_table SET request_status = 1, relationship_level = '$relationship_level' WHERE id=$id AND currentUser='$currentUser' AND otherUser='$otherUser'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    //add another entry into the relationship_table so that the user approving the friend request is also friends with the sender
    $sql = "UPDATE relationship_table SET request_status = 1, relationship_level = '$relationship_level' WHERE request_status = -1 AND currentUser='$otherUser' AND otherUser='$currentUser'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("location:  ../profile.php");

    $conn->close();

?>


