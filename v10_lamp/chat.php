<?php
    include_once 'header.php';
?>

<?php
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';
?>

<?php
// if there is a current session
if (isset($_SESSION["userName"])){
    $currentUser = $_SESSION["userName"];

    // display friends list
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
    $query = "SELECT * FROM relationship_table WHERE currentUser='$currentUser'";
    $friends_row_num = 1;
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            if($row["relationship_level"] == 1 || $row["relationship_level"] == 2){
                echo '<tr>';
                echo '<th scope="row">' .$friends_row_num.' </th>';
                echo '<td>'.$row["otherUser"]. '</td>';
                if(1) {
                    echo '<td>Online/Offline Status here [NYI]</td>';
                }
                else {
                    echo '<td>Online/Offline Status here [NYI]</td>';
                }
                echo '<td><form name="message" action=""><button name="recname" value="'.$row["otherUser"].'" type="submit" class="btn btn-dark chatinvite">Send Chat Request</button></form></td>';
                echo '</tr>';
                $friends_row_num = $friends_row_num+1;
            }
        }
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    //end friends list section

    // display received chat invites
    echo '<div class="container-fluid">';
    echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
    echo '<div class="container title"><h3>Requests </h3></div>';
    // create a table with received invites
    echo '<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>';
    $query = "SELECT * FROM chatroom_requests WHERE rec_name='$currentUser'";
    $friends_row_num = 1;
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<th scope="row">' .$friends_row_num.' </th>';
            echo '<td>'.$row["req_name"]. '</td>';
            echo '<td><form name="accept" action=""><button name="response" value="'.$row["req_name"].'" room="'.$row["room_id"].'" type="submit" class="btn btn-dark acceptinvite">Accept</button></form></td>';
            echo '<td><form name="reject" action=""><button name="response" value="'.$row["req_name"].'" room="'.$row["room_id"].'" class="btn btn-dark rejectinvite">Reject</button></form></td>';
            echo '</tr>';
            $friends_row_num = $friends_row_num+1;
        }
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    //end chat requests section
}
?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="js/chat.js"></script>

<?php
  include_once 'footer.php';
?>