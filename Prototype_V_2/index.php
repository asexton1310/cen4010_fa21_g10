<?php
  include_once 'header.php';
?>

<?php    
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';
    $query = "SELECT * FROM posts";
    if ($result = $conn->query($query)) {
      echo '<div class="main_container">';
  
      while ($row = $result->fetch_assoc()) {?>
      <?php if (isset($_SESSION["userName"])){ ?>
          <div class="post_container"><!--post with like and comment active due to user login starts-->
              <div class="post_top">
                  <img class = "profile_img post_profile_pic"
                      src=".\random_user1.png"
                      alt=""          
                  />
                  <div class = "post_info">
                      <h6><?php echo $row["usrName"]?></h6>
                      <p> date and time placeholder</p>
                  </div>
              </div>
              <div class="post_content">
                  <h3 class = "post_title"><?php echo $row["title"]?></h3>
                  <p class="post content"><?php echo $row["content"]?></p>
                </div>
                <div class="postimg">
                  <img class = "post_img"
                      src=".\post_placeholder.png"
                      alt=""          
                  />
                </div>
                <div class="post_totals">
                  <p>Likes count</p>
                  <p>comment count</p>
                  <p>shares count</p>
                </div>
                <div class="post_interact">
                  <span class="material-icons">favorite_border</span>
                  <span class="material-icons">chat_bubble_outline</span>
                  <span class="material-icons">ios_share</span>
                </div>
              </div><!--left sidebar class ends ends-->
            <?php } else { ?>
              <div class="post_container"><!--post with like and comment active due to user login starts-->
              <div class="post_top">
                  <img class = "profile_img post_profile_pic"
                      src=".\random_user1.png"
                      alt=""          
                  />
                  <div class = "post_info">
                      <h6><?php echo $row["usrName"]?></h6>
                      <p> date and time placeholder</p>
                  </div>
              </div>
              <div class="post_content">
                  <h3 class = "post_title"><?php echo $row["title"]?></h3>
                  <p class="post content"><?php echo $row["content"]?></p>
                </div>
                <div class="postimg">
                  <img class = "post_img"
                      src=".\post_placeholder.png"
                      alt=""          
                  />
                </div>
                <div class="post_totals">
                  <p>Likes count</p>
                  <p>comment count</p>
                  <p>shares count</p>
                </div>
                <div class="post_interact">
                  <span class="material-icons">ios_share</span>
                </div>
              </div><!--left sidebar class ends ends-->
            <?php }

      }
      echo '</div>';
      include 'right_bar.php';

  }    
      
?>


<?php
  include_once 'footer.php';
?>