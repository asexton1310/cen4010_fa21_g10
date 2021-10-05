<?php
  include_once 'header.php';
?>

<?php
  // if there is a current session
  if (isset($_SESSION["userName"])){
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    // select all from table relay_user
    $query = "SELECT * FROM relay_user";
    
    // if results
    if ($result = $conn->query($query)) {
        // loop thru each row of table
        while ($row = $result->fetch_assoc()) {
          // if current session matches user in relay_user print profile
          if($_SESSION["userName"] ==$row["userName"] ){
           echo '<div class="container-fluid">';
           echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
           echo '<div class="container title"><h3>profile</h3></div>';
           echo '<div class="container content">';
           echo '<p class="main">User Name: ' . $row["userName"] . '</p>'; 
           echo '<p class="main">First Name: ' . $row["firstName"] . '</p>'; 
           echo '<p class="main">Last Name: ' . $row["lastName"] . '</p>'; ;
           echo '<p class="main">Email: ' . $row["email"] . '</p>'; 
           echo '<p class="main">Bio: ' . $row["bio"] . '</p>'; 
           echo '<br>  ';
           echo '</div>';
           echo '<div class="container footer"><p class="footer">.</p></div>';
           echo '</div>';
          }
        }
      }
  }

  // return to index if no current session
  else{
    header("location: index.php");
  }
?>            

<?php
  include_once 'footer.php';
?>