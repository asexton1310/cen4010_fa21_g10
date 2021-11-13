<?php
    require_once 'script_db_connection.php';
    require_once 'script_functions.php';
?>
<?php

    session_start();
    //this section tracks that the user logged out
    $userName = $_SESSION["userName"];
    $sql = "DELETE FROM online_users WHERE userName='$userName'";
    
    if ($conn->query($sql) === TRUE) {
        header("location: ../chat.php");
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    session_unset();
    session_destroy();

    header("location: ..\index.php");
    exit();
