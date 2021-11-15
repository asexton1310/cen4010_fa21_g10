<?php
    include_once 'header.php';
?>

<?php
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';
?>

<?php
    if(!isset($_GET['room'])){	 
        //user did not specify a room, kick them
        header("Location: chat.php"); //Redirect the user
    }
    else{
        // check chatroom_participants table for this roomid and this username, if not there, redirect away
        $roomid = $_GET['room'];
        $userName = $_SESSION["userName"];

        //this participation check prevents the room closed message from appearing, not too bad, but probably worth changing
        $query = "SELECT * FROM chatroom_participants
                  WHERE room_id = $roomid AND userId = '$userName'";
    
        if ($result = $conn->query($query)) {
            if ($row = $result->fetch_assoc()) {
                echo '<div id="main_container" class="main_container">';
                echo '<div id="holdseverything"></div>';

                // display online friends list
                echo '<div class="container-fluid">';
                    echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
                    echo '<div class="container title"><h3>friends </h3></div>';
                    // create a table with current friends
                    echo '<table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>';
                    $query = "SELECT relationship_table.otherUser, relationship_table.relationship_level FROM relationship_table, online_users
                            WHERE (online_users.lastonline >= CURRENT_TIMESTAMP - INTERVAL 10 MINUTE AND
                                relationship_table.currentUser='$userName' AND relationship_table.otherUser = online_users.userName AND relationship_table.otherUser NOT IN (
                                SELECT userId FROM chatroom_participants WHERE room_id = $roomid)
                            )";
                    $friends_row_num = 1;
                    if ($result = $conn->query($query)) {
                        while ($row = $result->fetch_assoc()) {
                            if($row["relationship_level"] == 1 || $row["relationship_level"] == 2){
                                echo '<tr>';
                                echo '<th scope="row">' .$friends_row_num.' </th>';
                                echo '<td>'.$row["otherUser"]. '</td>';                      
                                echo '<td>Online</td>';
                                echo '<td><button name="recname" value="'.$row["otherUser"].'" type="submit" class="btn btn-dark chatinvite">Send Chat Request</button></td>';
                                echo '</tr>';
                                $friends_row_num = $friends_row_num+1;
                            }
                        }
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';

                    echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
                    echo '<script type="text/javascript" src="js/chatroom.js"></script>';
                echo '</div>';//close online friends list section

                echo '</div>'; //close main_container div
            }
            else {
                echo "You're not supposed to be in this chatroom >:(";
                header("Location: chat.php"); //Redirect the user
            }
            include 'right_bar.php';
        }
        else {
            echo "Error with query : " . $conn->error;
        }
    }
?>

<?php
  include_once 'footer.php';
?>