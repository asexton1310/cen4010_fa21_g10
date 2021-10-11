<?php
include_once 'header.php';
?>

<?php
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

	if($_SERVER['REQUEST_METHOD'] == "POST"){
	
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
	}
?>
<div class="main_container">
  <div class="login-box">
  <div class=""><h3>register</h3></div>
  <form action ="include/script_register.php" method = "POST">
      <div class="user-box">
        <label for="userName" class= "login_label">User Name</label>
        <input type="text" class="inputs_style" id="userName" name="userName">
      </div>
	    <div class="user-box">
        <label for="password" class= "login_label">Password</label>
        <input type="password" class="inputs_style" id="password"  name="passd">
      </div>
      <div class="user-box">
        <label for="firstName" class= "login_label">First Name</label>
        <input type="text" class="inputs_style" id="firstName" name="firstName">
      </div>
      <div class="user-box">
        <label for="lastName" class= "login_label">Last Name</label>
        <input type="text" class="inputs_style" id="lastName"  name="lastName">
      </div>
	    <div class="user-box">
        <label for="email" class= "login_label">Email Address</label>
        <input type="text" class="inputs_style" id="email"  name="email">
      </div>
      <button type="submit" name = "submit" class="btn_login">Submt</button>
    </div>
    </form>
  </div>
  </div
<?php
include_once 'footer.php';
?>