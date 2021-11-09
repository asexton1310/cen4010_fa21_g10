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
        $mode = $_POST["mode"];

        if ($mode === "create"){
            $sql = "INSERT INTO chatrooms (status)
                    VALUES (0)";
            if ($conn->query($sql) === TRUE) {
                echo json_encode($conn->insert_id); //return the autoincrement id from insert into in response
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
        else if ($mode === "adduser") {
            $roomid = $_POST['room'];

            $sql = "INSERT INTO chatroom_participants (room_id, userId, status)
                    VALUES ('$roomid', '$userName', '1')";
        
            if ($conn->query($sql) === TRUE) {
                header("location: ../chat.php");
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            } 
        }          
    }    
?>