<?php
    include_once 'header.php';
?>

<?php
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';
?>

<?php
echo '<div class="main_container">';
// if there is a current session
if (isset($_SESSION["userName"])){
    $currentUser = $_SESSION["userName"];

    // display received chat invites
    echo '<div class="container-fluid">';
    echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
    echo '<div class="container_title"><h3>Requests </h3></div>';
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
    echo '</div>';
    //end chat requests section
}
echo '</div>'; //close main_container
?>

<?php
//these are included in right_bar.php, so commented out from this
// <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
// <script type="text/javascript" src="js/chat.js"></script>

  include 'right_bar.php';
  include_once 'footer.php';
?>