<?php
  session_start();
?>

<?php
    require_once 'script_db_connection.php';
    require_once 'script_functions.php';
?>

<?php
    if(isset($_SESSION['userName'])){
        $userName = $_SESSION["userName"];
        $text = $_POST['text'];
        $roomid = $_POST['roomid'];
        
        $sql = "INSERT INTO chatroom_messages (room_id, userId, content)
                VALUES ($roomid, '$userName', '$text')";
        
        if ($conn->query($sql) === TRUE) {
            header("location: ../chatroom.php");
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>