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
        else if ($mode === "removeuser") {
            $roomid = $_POST['room'];

            $sql = "DELETE FROM chatroom_participants WHERE (room_id='$roomid' AND userId='$userName')";
        
            if ($conn->query($sql) === TRUE) {
                header("location: ../chat.php");
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            } 
        }
        else if ($mode === "getparticipants") {
            $roomid = $_POST['room'];

            $query = "SELECT COUNT(DISTINCT userId) as total FROM chatroom_participants
                      WHERE room_id = $roomid"; //count needs an alias for fetch_assoc to work 
        
            if ($result = $conn->query($query)) {
                echo $result->fetch_assoc()['total'];
            }
            else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        }
        else if ($mode === "closeroom") {
            $roomid = $_POST['room'];

            $sql = "DELETE FROM chatroom_participants WHERE (room_id='$roomid');"; //delete everyone in the chatroom
            $sql .= "UPDATE chatrooms SET status = -1 WHERE room_id = $roomid";  //set status to -1
        
            if ($conn->multi_query($sql) === TRUE) {
                header("location: ../chat.php");
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            } 
        }
    }    
?>