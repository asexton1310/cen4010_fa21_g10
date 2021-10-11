
<?php

if(isset($_POST["postSubmit"])){
    
 
        require_once 'script_db_connection.php';
        require_once 'script_functions.php';
        
        $userName = "Oni";
        $title = $_POST["title"];
        $content = $_POST["content"];
        $postLevel = $_POST["postLevel"];


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
      
        $sql = "INSERT INTO posts (usrName, title, content, postLevel)
            VALUES ('$userName', '$title', '$content', '$postLevel')";
      

        if ($conn->query($sql) === TRUE) {
           header("location: ../index.php");
         } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      
      $conn->close();
    

}

else{
    
  //  header("location: ../login.php");
 //   exit();
}


