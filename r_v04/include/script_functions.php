<?php

function emptyRegisterEntry($name, $passd, $firstName, $lastName, $email){
    $result;
    if(empty($name)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}


function userNameExists($conn, $userName, $passd){

    $sql = "SELECT * FROM relay_user where userName = ?";

    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.php");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $userName);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }

    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}

function loginUser($conn, $userName, $passd){
    /*
    $userNameExists = userNameExists($conn, $userName, $passd);

    if($userNameExists === false){
        header("location: ../login.php");
        exit();
    }

    //   $checkPassd = password_verify($passd, $userNameExists["passd"]);
    $checkPassd = true;

    if($checkPassd === false){
        header("location: ../login.php");
        exit();
    }

    else if($checkPassd === true){
        session_start();
   */     
    //    $uID = userNameExists("relay_userID");
    //    $uN = userNameExists("relay_userName");

     //   $_SESSION["userNameID"] = $userName;
        $_SESSION["userName"] = $userName;
        header("location: ../index.php");
        exit();
    }







