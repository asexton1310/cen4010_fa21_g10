<?php

if(isset($_POST["submit"])){
    
    $name = $_POST["userName"];
    $passd = $_POST["passd"];
    $passd2= $_POST["passd2"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];

    $userMatch = false;
    $emailMatch = false;
    $unmatched_passwords = false;
    $password_missing_lowercase = false;
    $password_missing_upperrcase = false;
    $password_missing_number = false;
    $password_too_short = false;
    $names_contain_non_letters = false;
    $invalid_email = false;

    require_once 'script_db_connection.php';
    require_once 'script_functions.php';

    $query = "SELECT * FROM relay_user";

    // checks if user name is in database
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            if($name == $row["userName"]){
                $userMatch = true;
            }
        }
    }

    // check if email is in use
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            if($email == $row["email"]){
                $emailMatch = true;
            }
        }
    }

    // checks if password and confirmation password match
    if($passd != $passd2){
        $unmatched_passwords = true;
    }

    // checks if password is missing a lowercase letter
    if(!preg_match('/[a-z]/', $passd)){
        $password_missing_lowercase = true;
    }

    // checks if password is missing an uppercase letter
    if(!preg_match('/[A-Z]/', $passd)){
        $password_missing_uppercase = true;
    }

    // checks if password is missing a number
    if(!preg_match('/[0-9]/', $passd)){
        $password_missing_number = true;
    }

    // checks if password is long enough
    if(strlen($passd) < 8){
        $password_too_short = true;
    }

    // checks if first or last name contains special characters
    if(preg_match('/[^a-zA-Z]/', $firstName) == true || preg_match('/[^a-zA-Z]/', $lastName) == true){
        $names_contain_non_letters = true;
    }

    // check email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $invalid_email = true;
    }

    if (empty($name) || empty($passd) || empty($firstName) || empty($lastName) || empty($email) ) {
        header("location: ../register.php?error=blank_entries");
        exit();
    }

    else if ($userMatch == true) {
        header("location: ../register.php?error=username_exists");
        exit();
    }

    else if ($unmatched_passwords == true) {
        header("location: ../register.php?error=unmatched_passwords");
        exit();
    }

    else if ($password_missing_lowercase == true) {
        header("location: ../register.php?error=password_missing_lowercase");
        exit();
    }

    else if ($password_missing_uppercase == true) {
        header("location: ../register.php?error=password_missing_uppercase");
        exit();
    }

    else if ($password_missing_number == true) {
        header("location: ../register.php?error=password_missing_number");
        exit();
    }

    else if ($password_too_short == true) {
        header("location: ../register.php?error=password_too_short");
        exit();
    }

    else if ($emailMatch == true) {
        header("location: ../register.php?error=email_exists");
        exit();
    }

    else if ($names_contain_non_letters == true) {
        header("location: ../register.php?error=names_contain_non_letters");
        exit();
    }

    else if ($invalid_email == true) {
        header("location: ../register.php?error=invalid_email");
        exit();
    }

    else{
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
      
        // $hashed_password = password_hash($passd, PASSWORD_DEFAULT);

        $sql = "INSERT INTO relay_user (userName, passd, firstName, lastName, email)
        VALUES ('$name', '$passd', '$firstName', '$lastName', '$email')";
      
        if ($conn->query($sql) === TRUE) {
            header("location: ../login.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      
        $conn->close();
    }
}

else{
    
    header("location: ../register.php");
    exit();
}