<?php 
$con = mysqli_connect('localhost', 'root', 'root', 'relay');

// Change the userform to relay user
?>
<?php
 $servername = "127.0.0.1";
 $username = "root";
 $password = "root";
 $dbname = "relay";
 $errors = array();
 // Create connection
 if(!$conn = new mysqli($servername, $username, $password, $dbname))
 {
	die("failed to connect!");
 }