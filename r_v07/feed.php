<?php
    include_once 'header.php';
?>

<?php
    
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    $currentUser = $_SESSION["userName"];

    $query = "SELECT * FROM posts, (SELECT currentUser, relationship_level FROM relationship_table WHERE otherUser='$currentUser' AND relationship_level >= 1) AS relationship_results
              WHERE posts.postLevel <= relationship_results.relationship_level AND posts.usrName = relationship_results.currentUser";

    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $post_level = $row['postLevel'];
         //   echo "$relationship_level - $post_level <br />";
            //$_SESSION["userName"]
            if($post_level >= 1){
                echo '<div class="container-fluid">';
                echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
                echo '<div class="container title"><h3>'; echo '<a href="user_profile.php?usrName='.$row["usrName"].'">'; echo $row["usrName"]; echo '</a>'; echo " // "; echo $row["title"];  echo " // "; echo $row["postDate"]; echo '</h3></div>';
                echo '<div class="container content">';
                echo $row["content"]; 
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



