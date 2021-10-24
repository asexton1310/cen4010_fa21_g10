<?php
  include_once 'header.php';
?>

<?php
  // if there is a current session
  if (isset($_SESSION["userName"])){

    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    $usrName = $_GET['usrName'];
    $currentUser = $_SESSION["userName"];

    // check friendship status
    $isCurrentFriend = 0;
    
    $queryRelationship = "SELECT * FROM relationship_table";
    // if results
    if ($resultRelationship = $conn->query($queryRelationship)) {
      // loop thru each row of table
      while ($rowRelationship = $resultRelationship->fetch_assoc()) {
        if($currentUser ==$rowRelationship["currentUser"] && $usrName == $rowRelationship["requestor_name"] &&  $rowRelationship["relationship_level"] == 1){
          $isCurrentFriend = 1;
        }
        else if($currentUser ==$rowRelationship["currentUser"] && $usrName == $rowRelationship["requestor_name"] &&  $rowRelationship["request_status"] == 0){
          $isCurrentFriend = 2;
        }
      }
    }

    $query = "SELECT * FROM relay_user";
    
    // if results
    if ($result = $conn->query($query)) {
        // loop thru each row of table
        while ($row = $result->fetch_assoc()) {
          if($usrName ==$row["userName"] ){
           echo '<div class="container-fluid">';
           echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
           echo '<div class="container title"><h3>user profile</h3></div>';  

           echo '<div class="container content">';
           echo '<p class="main">User Name: ' . $row["userName"] . '</p>'; 
           echo '<p class="main">First Name: ' . $row["firstName"] . '</p>'; 
           echo '<p class="main">Last Name: ' . $row["lastName"] . '</p>'; ;
           echo '<p class="main">Bio: ' . $row["bio"] . '</p>'; 
           echo '<br>  ';
           echo '</div>';
           echo '<div class="container content">';
           if($isCurrentFriend == 0){
             echo '<a href="include/script_add_request.php?requestor_name='.$row["userName"].'">'; echo " request friendship"; echo '</a>';
           }
           else if($isCurrentFriend == 1){
            echo '<a href="include/script_add_request.php?requestor_name='.$row["userName"].'">'; echo " remove friend"; echo '</a>';
       
           }
           else if($isCurrentFriend == 2){
            echo " request sent";
           }
           echo '</div>';
           echo '<div class="container footer"><p class="footer">.</p></div>';
           echo '</div>';
          }
        }
      }
  
  
      $query = "SELECT * FROM posts";

      if ($result = $conn->query($query)) {
      
          while ($row = $result->fetch_assoc()) {
          
            if($usrName == $row["usrName"]){
              echo '<div class="container-fluid">';
              echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
              echo '<div class="container title"><h3>';  echo $row["usrName"]; echo " // "; echo $row["title"]; echo '</h3></div>';
              echo '<div class="container content">';
              echo $row["content"]; 
              echo '<br>';
              echo '<br>';
              echo '</div>';
              echo '<div class="container footer"><p class="footer">.</p></div>';
              echo '</div>';
              echo '</div>';
           }
          }
      }       
  
  
  
  
  
  
  
  
    } // end if

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  // return to index if no current session
  else{
    header("location: login.php");
  }
?>            

<?php
  include_once 'footer.php';
?>