<?php
  include_once 'header.php';
?>

<div class="main_container">
    <div class="login-box">
    <div class=""><h3>login</h3></div>
    <form action = "include/script_login.php" method="post">
        <div class="user-box">
          <label for="username" class= "login_label">Username</label>
          <input type="text" class="inputs_style" id="username" aria-describedby="usernameHelp" placeholder="Enter Username" name="userName">

        </div>
        <div class="form-group">
          <label for="password" class= "login_label">Password</label>
          <input type="password" class="inputs_style" id="password" placeholder="Password" name="passd">
        </div>
        <br>
        <button type="submit" name = "login" class="btn_login">Login</button>
      </form>

      <?php
        // display login error messages to user
        if(isset($_GET['error'])){
            if($_GET['error'] == "invalid_username"){
              echo "<p>invalid username</p>";
            }

            else if($_GET['error'] == "invalid_password"){
              echo "<p>invalid password</p>";
            }
            
            else if($_GET['error'] == "empty_username"){
              echo "<p>missing username</p>";
            }
            
            else if($_GET['error'] == "empty_password"){
              echo "<p>missing password</p>";
            }
           
            else if($_GET['error'] == "all_fields_empty"){
              echo "<p>missing username and password</p>";
            }
         }
      ?>
     
      <br>
    <div class="container footer"><p class="footer">.</p></div>
</div>>


<?php
  include_once 'footer.php';
?>