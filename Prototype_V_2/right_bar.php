<?php if (isset($_SESSION["userName"])){ ?>
      <div class="right_side_bar_in"><!--right sidebar active due to user login starts-->
        <div class="right_sidebar_title_row">
          <h4>Live Friends</h4>
        </div>
        <div class="right_sidebar_row">
          <span id = "Message" class="material-icons">account_circle</span>
          <h6>online_User_1</h6>
          <span class="material-icons">message</span>
        </div>
        <div class="right_sidebar_row">
          <span class="material-icons">account_circle</span>
          <h6>online_User_2</h6>
          <span id = "Message" class="material-icons">message</span>
        </div>
      </div><!--right sidebar class ends ends-->
    <?php } else { ?>
      <div class="right_side_bar_in" style = "visibility: hidden";><!--right sidebar is Hidden due to No User login stays for the shape--> 
        <div class="right_sidebar_title_row">
          <h4>Live Friends</h4>
        </div>
        <div class="right_sidebar_row">
          <span id = "Message" class="material-icons">account_circle</span>
          <h6>online_User_1</h6>
          <span class="material-icons">message</span>
        </div>
        <div class="right_sidebar_row">
          <span class="material-icons">account_circle</span>
          <h6>online_User_2</h6>
          <span id = "Message" class="material-icons">message</span>
        </div>
      </div>
    <?php } ?>



    <div class="left_side_bar_out">
      </div><!--left sidebar class ends ends-->
      <!--in its own file beacuse of html parent/child logic-->