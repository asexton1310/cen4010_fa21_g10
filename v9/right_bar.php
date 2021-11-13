<?php
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';
?>
<?php 
if (isset($_SESSION["userName"])){
    //below query selects users friends that are also online
    $query = "SELECT relationship_table.otherUser, relationship_table.relationship_level FROM relationship_table, online_users
                          WHERE (relationship_table.currentUser='$userName' AND relationship_table.otherUser = online_users.userName
                          )";
    $friends_row_num = 1;
    if ($result = $conn->query($query)) {
        ?>
        <div class="right_side_bar_in"><!--right sidebar active due to user login starts-->
            <div class="right_sidebar_title_row">
                <h4>Live Friends</h4>
            </div>
            <?php
            while ($row = $result->fetch_assoc()) {
                if($row["relationship_level"] == 1 || $row["relationship_level"] == 2){
                    echo '
                    <div class="right_sidebar_row">
                        <span class="material-icons">account_circle</span>
                            <h6>'.$row["otherUser"].'</h6>
                        <span id="Message" class="material-icons chatinvite">message</span>
                    </div>
                    ';
                    $friends_row_num = $friends_row_num+1;
                }
            }
            ?>
      </div><!--right sidebar class ends ends-->
    <?php 
    } 
} else { ?>
      <div class="right_side_bar_in" style = "visibility: hidden";><!--right sidebar is Hidden due to No User login stays for the shape--> 
        <div class="right_sidebar_title_row">
          <h4>Live Friends</h4>
        </div>
      </div><!--right sidebar class ends ends-->
    <?php } ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="js/chat.js"></script>

    <div class="left_side_bar_out">
      </div><!--left sidebar class ends ends-->
      <!--in its own file beacuse of html parent/child logic-->