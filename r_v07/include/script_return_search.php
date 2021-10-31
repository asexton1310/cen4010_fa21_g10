<?php
  session_start();
?>




<?php

    require_once 'script_db_connection.php';
    require_once 'script_functions.php';
	$search = $_POST['search']; 




    $search_value=$_POST["search"];

    if($conn->connect_error){
        echo 'Connection Faild: '.$conn->connect_error;
        }else{
            $sql="select * from relay_user where userName like '%$search_value%'";
    
            $res=$conn->query($sql);
    
            while($row=$res->fetch_assoc()){
                echo 'First_name:  '.$row["userName"];
    
    
                }       
    
            }
    ?>