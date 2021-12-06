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
  <form action ="include/script_register.php" class="form_style"method = "POST">
    <div class="user-box">
        <label for="userName" class= "login_label">Username</label>
        <input type="text" class="inputs_style" id="userName" name="userName">
      </div>
      <div class="user-box">
        <label for="password" class= "login_label">Password</label>
        <input type="password" class="inputs_style" id="password"  name="passd">
      </div>

      <div class="user-box">
        <label for="password2" class= "login_label">Confirm Password</label>
        <input type="password" class="inputs_style" id="password2"  name="passd2">
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
      <p class= "text-white">By clicking Submit you agree to our <a href="policies.php" rel="external nofollow noopener" target="_blank">Terms, and Privacy Policy.</a></p>
      <?php 
        // registation error messages
        if(isset($_GET['error'])){
            if($_GET['error'] == "username_exists"){
              echo "<p>username exists</p>";
            }

            else if($_GET['error'] == "email_exists"){
              echo "<p>email exists</p>";
            }
            
            else if($_GET['error'] == "unmatched_passwords"){
              echo "<p>passwords do not match</p>";
            }

            else if($_GET['error'] == "password_missing_lowercase"){
                echo "<p>password must contain at least one lowercase letter</p>";
            }
            else if($_GET['error'] == "password_missing_uppercase"){
                echo "<p>password must contain at least one uppercase letter</p>";
            }
            else if($_GET['error'] == "password_missing_number"){
                echo "<p>password must contain at least one number</p>";
            }
            else if($_GET['error'] == "password_too_short"){
                echo "<p>password must be at least 8 characters long</p>";
            }

            else if($_GET['error'] == "blank_entries"){
              echo "<p>one or more entries left blank</p>";
            }
            else if($_GET['error'] == "names_contain_non_letters"){
              echo "<p>first name or last name cannot contain numbers or special characters</p>";
            }
            else if($_GET['error'] == "invalid_email"){
              echo "<p>invalid email entry</p>";
            }
      
          }
      ?>
          <button type="submit" name = "submit" class="btn_login">Submit</button>
    </div>
    

    </div>
    </form>
  </div>
  </div
<?php
include_once 'footer.php';
?>