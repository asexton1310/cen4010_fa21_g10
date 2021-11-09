<?php
  include_once 'header.php';
?>

<?php    
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    $query = "SELECT * FROM posts ORDER by id DESC";

    if ($result = $conn->query($query)) {
    
        while ($row = $result->fetch_assoc()) {
        
          if($row["postLevel"] == 0){
            echo '<div class="container-fluid">';
            echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
            echo '<div class="container title"><h3>'; echo '<a href="user_profile.php?usrName='.$row["usrName"].'">'; echo $row["usrName"]; echo '</a>'; echo " // "; echo $row["title"];  echo " // "; echo $row["postDate"]; echo '</h3></div>';
            echo '<div class="container content">';
            echo $row["content"]; 
            echo '<br>';
            if ($row["image"])
            {
            ?>
           <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style='height: 100%; width: 100%; object-fit: cover' /> 
            <?php }
            echo '<br>';
            echo '<br>';
            echo '</div>';
            echo '<div class="container footer"><p class="footer">'; echo '<a href="include/script_add_likes.php?id='.$row["id"].'&likes='.$row["likes"].'">'; echo 'like  </a> // '; echo $row["likes"]; echo '</p></div>';
            echo '</div>';
            echo '</div>';
         }
        }
    }       

?>

<?php
  include_once 'footer.php';
?>


