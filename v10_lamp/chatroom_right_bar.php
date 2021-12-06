<?php
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';
?>
<?php 
if (isset($_SESSION["userName"])){
    //below query selects users friends that are also online
    $query = "SELECT relationship_table.otherUser, relationship_table.relationship_level FROM relationship_table, online_users
                          WHERE (online_users.lastonline >= CURRENT_TIMESTAMP - INTERVAL 10 MINUTE AND 
                                 relationship_table.currentUser='$userName' AND relationship_table.otherUser = online_users.userName
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

    <div class="left_side_bar_out">
      </div><!--left sidebar class ends ends-->
      <!--in its own file beacuse of html parent/child logic-->