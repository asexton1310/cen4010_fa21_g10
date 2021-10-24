<?php
    include_once 'header.php';
?>

<?php
    
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';




    $query = "SELECT posts.usrName, posts.title, posts.content, posts.postLevel, posts.postDate, posts.id, posts.likes, relationship_table.requestor_name, relationship_table.currentUser, relationship_table.relationship_level  from posts, relationship_table where posts.postLevel = relationship_table.relationship_level";

    if ($result = $conn->query($query)) {
    
        while ($row = $result->fetch_assoc()) {
            
            $posterUserName = $row['usrName'];
            $friendName = $row['requestor_name'];

            $relationship_level = $row['relationship_level'];
            $post_level = $row['postLevel'];

         //   echo "$relationship_level - $post_level <br />";
            //$_SESSION["userName"]
            if($post_level >= 1){
                if($posterUserName == $friendName && $_SESSION["userName"] != $posterUserName){
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
    }       

?>



