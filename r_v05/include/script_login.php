<?php
if(isset($_POST["login"])){


    $userName = $_POST["userName"];
    $passd = $_POST["passd"];

    $userMatch = false;
    $accountMatch = false;
    $invalid_password = true;

    require_once 'script_db_connection.php';
    require_once 'script_functions.php';

    $query = "SELECT * FROM relay_user";

    // checks if user name is in database
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            if($userName == $row["userName"]){
                $userMatch = true;
            }
        }
    }

    // if user exists checks password
    if($userName == true){
            if ($result = $conn->query($query)) {
            while ($row = $result->fetch_assoc()) {
                if($userName == $row["userName"] && $passd == $row["passd"]){
                    $invalid_password = false;
                }
            }
        }
    } 

    if (empty($passd) == true && empty($userName) == true) {
        header("location: ../login.php?error=all_fields_empty");
        exit();
    }
    
    else if (empty($userName)) {
        header("location: ../login.php?error=empty_username");
        exit();
    }

    else if (empty($passd)) {
        header("location: ../login.php?error=empty_password");
        exit();
    }
    
    else if ($userMatch == false) {
        header("location: ../login.php?error=invalid_username");
        exit();
    }

    else if ($invalid_password == true) {
        header("location: ../login.php?error=invalid_password");
        exit();
    }
    /*else{
        loginUser($conn,$userName,$passd);
        header("location: ../index.php?succes=loggedin");
        exit();
    }*/

    if($userMatch == true){
        session_start();
        $_SESSION["userName"] = $userName;
        header("location: ../index.php");
        exit();
    }

}

else{
    header("location: ../login.php?error=empty_username");
exit();
}










/*


    
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            if($userName == $row["userName"] && $passd == $row["passd"]){
                $userMatch = true;
            }
        }
    }




    else{
        header("location: ../login.php?error=emptyinput");
        exit();
    }
*/
