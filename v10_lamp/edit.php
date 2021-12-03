<?php
  include_once 'header.php';
?>

<?php
  // if there is a current session
  if (isset($_SESSION["userName"])){
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    $currentUser = $_SESSION["userName"];
    $query = "SELECT * FROM relay_user WHERE userName='$currentUser'";
    // if results
    if ($result = $conn->query($query)) {
        $row = $result->fetch_assoc();
        echo '<div class="container-fluid">';
        echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
        echo '<div class="container title"><h3>personal profile</h3></div>';
        echo '<div class="container content">';
        echo '<p class="main">User Name: ' . $row["userName"] . '</p>'; 
        echo '<p class="main">First Name: ' . $row["firstName"] . '</p>'; 
        echo '<p class="main">Last Name: ' . $row["lastName"] . '</p>'; ;
        echo '<p class="main">Email: ' . $row["email"] . '</p>'; 
        echo '<form action="include/script_update_account.php" method="post">';
        echo '<p class="main">Bio: </p>'; 
        echo '<textarea class="form-control" id="bio" rows="3" name = "bio">' . $row["bio"] . '</textarea>';
        echo '<input type="submit" value="enter" name="postBio">';  
        echo '</form>';
        echo '<br>';
        echo '</div>';
        echo '<div class="container footer"><p class="footer">.</p></div>';
        echo '</div>';
    }
    }
        ?>
