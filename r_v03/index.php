<?php
  include_once 'header.php';
?>

<?php    
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    $query = "SELECT * FROM posts";

    if ($result = $conn->query($query)) {
    
        while ($row = $result->fetch_assoc()) {
        
          if($row["postLevel"] == 0){
            echo '<div class="container-fluid">';
            echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
            echo '<div class="container title"><h3>'; echo '<a href="user_profile.php?usrName='.$row["usrName"].'">'; echo $row["usrName"]; echo '</a>'; echo " // "; echo $row["title"]; echo '</h3></div>';
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

?>

<?php
  include_once 'footer.php';
?>


