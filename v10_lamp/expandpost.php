<?php
  include_once 'header.php';
?>

<?php    
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    $userName = $_SESSION["userName"];
    $postid = sanitizeString($_GET['id']);

    //first get posts' author and post's level
    $query = "SELECT usrName, postLevel FROM posts WHERE id = '$postid'";

    echo '<div class="main_container">';
    if ($result = $conn->query($query)) {
        $row = $result->fetch_assoc();
        $postLevel = $row["postLevel"];
        //determine sql statement based on post level
        if($postLevel == 0){
            //if post is public, select it unconditionally
            $sql = "SELECT * FROM posts WHERE id = $postid";
        }
        else {
            //post is friends or best friends only, so only select the post if
            //the author's friend level for this user is sufficient to view this post
            $sql = "SELECT * FROM posts WHERE id = '$postid' AND usrName IN (
                SELECT currentUser FROM relationship_table WHERE otherUser = '$userName' AND relationship_level >= '$postLevel'
            )";
        }
        if ($result = $conn->query($sql)) {
            if (mysqli_num_rows($result) == 1) { 
                $row = $result->fetch_assoc();?>
                <div class="post_container"><!--post with like and comment active due to user login starts-->
                    <div class="post_top">
                        <img class = "profile_img post_profile_pic"
                                    src="my_profile_placeholder.jpg"
                                    alt=""          
                                />
                        <div class = "post_info">
                            <h6><?php echo $row["usrName"]?></h6>
                            <p> <?php echo $row["postDate"]?></p>
                        </div>
                    </div>
                    <div class="post_content">
                        <h3 class = "post_title"><?php echo $row["title"]?></h3>
                        <p class="post teaser"><?php echo $row["teaser"]?></p>
                        <p class="post content"><?php echo $row["content"]?></p>
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
            } //close if (mysqli_num_rows() == 1)
            else {
                ?>
                <div class="post_container"><!--post with like and comment active due to user login starts-->
                    <p>You do not have the required permission to view this post.</p>
                </div>
                <?php
            }
        }// close if ($conn->query($sql) === TRUE)
    } //close if ($result = $conn->query($query))
  echo '</div>'; //this closes the <div class="main_container"> so that right bar displays properly 
  include 'right_bar.php';   
?>

<?php
  include_once 'footer.php';
?>


