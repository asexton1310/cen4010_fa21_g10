<?php
  include_once 'header.php';
?>

<div class="container-fluid">
    <div class="container-sm posts shadow p-3 mb-5 bg-white rounded">
    <div class="container title"><h3>login</h3></div>
    <form action = "include/script_login.php" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Enter Username" name="userName">

        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password" name="passd">
        </div>
        <br>
        <button type="submit" name = "login" class="btn btn-dark">Login</button>
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