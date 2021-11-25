<?php
if(isset($_POST["login"])){
    require_once 'script_db_connection.php';
    require_once 'script_functions.php';

    $userName = sanitizeString($_POST["userName"]);
    $passd = sanitizeString($_POST["passd"]);

    $userMatch = false;
    $accountMatch = false;
    $invalid_password = true;

    $hash_entered_password = md5($passd);

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
               
               if(password_verify($passd, $row["passd"]) >= 1){
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
        //track that the user is now online
        $query = "INSERT INTO online_users (userName)
                  VALUES ('$userName')";

        if ($result = $conn->query($query)) {
            header("location: ../feed.php");
        }
        else {
            header("location: ../index.php?error=activityfail");
        }
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
