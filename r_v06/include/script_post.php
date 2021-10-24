<?php
  session_start();
?>



<?php

if(isset($_POST["postSubmit"])){
    
 
        require_once 'script_db_connection.php';
        require_once 'script_functions.php';
        
        $userName = $_SESSION["userName"];
        $title = $_POST["title"];
        $content = $_POST["content"];
        $postLevel = $_POST["postLevel"];
        $date = date("Y-m-d");


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
      
        $sql = "INSERT INTO posts (usrName, title, content, postLevel, postDate)
            VALUES ('$userName', '$title', '$content', '$postLevel', '$date')";
      

        if ($conn->query($sql) === TRUE) {
           header("location: ../index.php");
         } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      
      $conn->close();
    

}

else{
    
   header("location: ../login.php");
    exit();
}

