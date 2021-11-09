<?php
  session_start();
?>

<?php
    require_once 'script_db_connection.php';
    require_once 'script_functions.php';

    $currentUser = $_SESSION["userName"];
    $otherUser = $_GET['otherUser'];

    echo $otherUser;

    //delete the 
    $sql = "DELETE FROM relationship_table WHERE (currentUser='$currentUser' AND otherUser='$otherUser') OR (currentUser='$otherUser' AND otherUser='$currentUser')";
    if ($conn->query($sql) === TRUE) {
        echo "Deleted " . $result->affected_rows . " rows";
        echo "Records deleted successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("location:  ../profile.php");

    $conn->close();

?>


