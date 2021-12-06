<?php
    include_once 'header.php';
?>

<?php
    
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    $currentUser = $_SESSION["userName"];

    $query = "SELECT * FROM posts, (SELECT currentUser, relationship_level FROM relationship_table WHERE otherUser='$currentUser' AND relationship_level >= 0) AS relationship_results
              WHERE posts.postLevel <= relationship_results.relationship_level AND posts.usrName = relationship_results.currentUser";

    echo '<div class="main_container">';

    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $post_level = $row['postLevel'];
         //   echo "$relationship_level - $post_level <br />";
            //$_SESSION["userName"]
            if($post_level >= 0){ ?>
                <div class="post_container bg-white"><!--post with like and comment active due to user login starts-->
                    <div class="post_top">
                        <img class = "profile_img post_profile_pic"
                                    src="my_profile_placeholder.jpg"
                                    alt=""          
                                />
                        <div class = "post_info">
                            <h6><?php echo '<a href="user_profile.php?usrName='.$row["usrName"].'">'; echo $row["usrName"]; echo '</a>';?></h6>
                            <p> <?php echo $row["postDate"]?></p>
                        </div>
                    </div>
                    <div class="post_content">
                            <h3 class = "post_title"><?php echo '<a href="expandpost.php?id='.$row["id"].'">'.$row["title"].'</a>'?></h3>
                            <p class="post teaser"><?php echo $row["teaser"]?></p>
                    </div>
                    <div class="postimg">
                            <img class = "post_img" onerror='this.style.display = "none"'
                            src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style='height: 100%; width: 100%; object-fit: cover'
                                alt=""          
                            />
                    </div>
                    <div class="post_totals">
                            <p><?php echo $row["likes"]?> Likes</p>
                            <p>comment count</p>
                            <p>shares count</p>
                    </div>
                    <div class="post_interact">
                            <?php
                            echo '<a class = "interaction_option" href="include/script_add_likes.php?id='.$row["id"].'&likes='.$row["likes"].'">';
                            echo '                  <span style="display: block;" class="material-icons">favorite_border</span>  </a> ';
                            ?> 
                            <span class="material-icons">chat_bubble_outline</span>
                            <span class="material-icons">ios_share</span>
                    </div>
                </div>
            <?php
            } //close the if($post_level >= 1)
        } //close the while loop
    }//close the if ($result = $conn->query($query))  
    echo '</div>'; //this closes the <div class="main_container"> so that right bar displays properly     
    include 'right_bar.php';
?>



