<?php
if(isset($_POST["login"])){


    $userName = $_POST["userName"];
    $passd = $_POST["passd"];

    require_once 'script_db_connection.php';
    require_once 'script_functions.php';

    $query = "SELECT * FROM relay_user";


    $userMatch = false;

    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            if($userName == $row["userName"] && $passd == $row["passd"]){
                $userMatch = true;
            }
        }
    }


    if($userMatch == true){
        session_start();
        $_SESSION["userName"] = $userName;
        header("location: ../index.php");
        exit();
    }

    else{
        header("location: ../login.php");
        exit();
    }
}

else{
    header("location: ../login.php");
    exit();
}

