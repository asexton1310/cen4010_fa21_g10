<?php
  session_start();
?>

<?php
    require_once 'script_db_connection.php';
    require_once 'script_functions.php';
?>

<?php
    $roomid = $_GET["roomid"];

    $query = "SELECT * FROM chatroom_messages
              WHERE room_id = $roomid";

    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="container content">';
            echo '<b>'.$row["date"].' '.$row["userId"].': </b>'.$row["content"]; 
            echo '</div>';
        }
    }       
?>