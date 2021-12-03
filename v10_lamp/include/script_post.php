<?php
  session_start();
?>


<?php

require_once 'script_db_connection.php';
require_once 'script_functions.php';


if(isset($_POST["postSubmit"])){
    
        //sanitizeString is used below to protect user input
        $userName = $_SESSION["userName"];
        $title = sanitizeString($_POST["title"]);
        $content = sanitizeString($_POST["content"]);
        $teaser = sanitizeString($_POST["teaser"]);
        $postLevel = $_POST["postLevel"];
        $date = date("Y-m-d");

        
        if (empty($title)) {
            header("location: ../post.php?error=title_empty");
            exit();
        }

        else if (empty($content)) {
            header("location: ../post.php?error=content_empty");
            exit();
        }

        else {

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if(!empty($_FILES["image"]["name"])) { 
                $fileName = basename($_FILES["image"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
    
                $allowTypes = array('jpg','jpeg','png'); 
                if(in_array($fileType, $allowTypes))
                { 
                    $image = $_FILES['image']['tmp_name'];
                    $imgContent = addslashes(file_get_contents($image)); 
                }
                else{
                header("location: ../post.php?error=format_error");
                exit();
                }
            }
            //insert the new post into posts table
            $sql = ("INSERT into posts (usrName, title, teaser, content, image, postLevel, postDate) 
                     VALUES ('$userName', '$title', '$teaser', '$content', '$imgContent', '$postLevel', '$date')"); 

            if ($conn->query($sql) === TRUE) {
                header("location: ../index.php");
                } 
                else {
                    header("location: ../post.php?error=format_error");
                    exit();
                }
            }
          
          $conn->close();
        
        }


    else{
        
       header("location: ../login.php");
        exit();
    }
?>