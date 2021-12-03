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
    $sql = "UPDATE relationship_table SET relationship_level = '$relationship_level' WHERE id=$id AND currentUser='$currentUser' AND otherUser='$otherUser'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("location:  ../profile.php");

    $conn->close();

?>


