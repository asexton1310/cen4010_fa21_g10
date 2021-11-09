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
        $otherUser = $_POST['otherUser'];
        $mode = $_POST['mode'];
        $roomid = $_POST['room'];
        
        if ($mode === "invite") {
            $sql = "INSERT INTO chatroom_requests (req_name, rec_name, room_id)
                    VALUES ('$userName', '$otherUser', '$roomid')";
    
            if ($conn->query($sql) === TRUE) {
                header("location: ../chat.php");
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            } 
        }
        else if ($mode === "reject") {
            $sql = "DELETE FROM chatroom_requests WHERE (rec_name='$userName' AND req_name='$otherUser')";

            if ($conn->query($sql) === TRUE) {
                echo "Deleted " . $result->affected_rows . " rows";
                echo "Records deleted successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
        else if ($mode ==="accept") {
            $sql = "UPDATE chatrooms SET status = 1 WHERE room_id = $roomid;";
            $sql .= "DELETE FROM chatroom_requests WHERE (rec_name='$userName' AND req_name='$otherUser')";

            if ($conn->multi_query($sql) === TRUE) {
                echo json_encode($conn->insert_id); //return the autoincrement id from insert into in response
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }    
?>