<?php

if(isset($_POST["submit"])){
    
    $name = $_POST["userName"];
    $passd = $_POST["passd"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    
    require_once 'script_db_connection.php';
    require_once 'script_functions.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      
      $sql = "INSERT INTO relay_user (userName, passd, firstName, lastName, email)
      VALUES ('$name', '$passd', '$firstName', '$lastName', '$email')";
      
      if ($conn->query($sql) === TRUE) {
        header("location: ../login.php");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
      $conn->close();

}

else{
    
    header("location: ../register.php");
    exit();
}