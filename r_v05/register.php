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

  <div class="container-sm posts shadow p-3 mb-5 bg-white rounded">
  <div class="container title"><h3>register</h3></div>
  <div class="container content">

  <form action ="include/script_register.php" method = "POST">
    <div class="form-row">

      <div class="form-group col-md-6">
        <label for="userName">Username</label>
        <input type="text" class="form-control" id="userName" name="userName">
      </div>
     
	       <div class="form-group col-md-6">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password"  name="passd">
      </div>

      <div class="form-group col-md-6">
        <label for="password2">Confirm Password</label>
        <input type="password" class="form-control" id="password2"  name="passd2">
      </div>
      
      <div class="form-group col-md-6">
        <label for="firstName">First Name</label>
        <input type="text" class="form-control" id="firstName" name="firstName">
      </div>
    
      <div class="form-group col-md-6">
        <label for="lastName">Last Name</label>
        <input type="text" class="form-control" id="lastName"  name="lastName">
      </div>
     
	    <div class="form-group col-md-6">
        <label for="email">Email Address</label>
        <input type="text" class="form-control" id="email"  name="email">
      </div>


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
     
      <br>
    </div>
    </div>
    <br>
    <button type="submit" name = "submit" class="btn btn-dark">Submt</button>
    </form>
    <br><br>
    <div class="container footer"><p class="footer">.</p></div>
  </div>

 <div class="container">

</div>
<?php
include_once 'footer.php';
?>