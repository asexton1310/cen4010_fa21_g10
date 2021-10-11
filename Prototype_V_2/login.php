<?php
  include_once 'header.php';
?>

<div class="main_container">
  <div class="login-box">
    <div class=""><h3>login</h3></div>
    <form action = "include/script_login.php" method="post">
      <div class="user-box">
      <label class= "login_label">Email</label>
        <input type="text" class = "inputs_style"id="email" aria-describedby="emailHelp" placeholder="Enter email" name="userName">
        
      </div>
      <div class="user-box">
        <label class= "login_label" >Password</label>
        <input type="password" class = "inputs_style" id="password" placeholder="Password" name="passd">
      </div>
      <br>
      <button type="submit" name = "login" class="btn_login">
        <span></span>
        <span></span> 
        <span></span> 
        <span></span>  
      Login
    </button>
    </form>
  </div>
</div>


<?php
  include_once 'footer.php';
?>