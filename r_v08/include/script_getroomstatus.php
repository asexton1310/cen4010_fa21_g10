<?php
  session_start();
?>

<?php
    require_once 'script_db_connection.php';
    require_once 'script_functions.php';
?>

<?php
    $roomid = $_GET["roomid"];

    $query = "SELECT * FROM chatrooms
              WHERE room_id = $roomid";

    $response = new stdClass();

    if ($result = $conn->query($query)) {
        if ($row = $result->fetch_assoc()) {
            if ($row["status"] === "-1") {
                $response->roomstatus = (int) $row["status"];
                $response->html = "This room has been closed.";

                echo json_encode($response);
            }
            else if ($row["status"] === "0") {
                $response->roomstatus = (int) $row["status"];
                $response->html = "Waiting for another user";

                echo json_encode($response);
            }
            else if ($row["status"] === "1") {
                $response->roomstatus = (int) $row["status"];
                $response->html = '
                <div class="container-sm posts shadow p-3 mb-5 bg-white rounded">
                    <div class="container title">
                        <h3>Chat. Welcome, <b>'.$_SESSION['userName'].'</b></h3>
                        <p id="displaystatus"></p>
                        <p class="logout"><a id="exit" href="#">Exit Chatroom</a></p>
                    </div>

                    <div class="container content">
                        <p class="main" id="chatbox"></p>
                        <br>
                    </div>

                    <div class="container footer">
                        <form name="message" action="">
                            <input name="userMsg" type="text" id="userMsg" placeholder="Type here to chat." />
                            <button name="userSubmit" type="submit" id="userSubmit" class="btn btn-dark">Send</button>
                        </form>
                    </div>
                </div>';

                echo json_encode($response);
            }
        }
    } 
    else {
        echo "Error with query : " . $conn->error;
    }   
?>