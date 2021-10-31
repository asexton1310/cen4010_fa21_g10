<?php
 $servername = "127.0.0.1";
 $username = "root";
 $password = "root";
 $dbname = "mysql";
 // Create connection
 if(!$conn = new mysqli($servername, $username, $password, $dbname))
 {
	die("failed to connect!");
 }