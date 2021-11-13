<?php
  session_start();
?>

<?php
if(isset($_SESSION["userName"])){
    $userMatch = false;
    $emailMatch = false;
    $unmatched_passwords = false;
    $password_missing_lowercase = false;
    $password_missing_uppercase = false;
    $password_missing_number = false;
    $password_too_short = false;
    $names_contain_non_letters = false;
    $invalid_email = false;
    $error_header = "location: ../profile.php?";

    require_once 'script_db_connection.php';
    require_once 'script_functions.php';

    $currentUser = $_SESSION["userName"];

    $query = "SELECT * FROM relay_user";

    $firstUpdate = true;

    $sql = "UPDATE relay_user SET "; //incomplete sql query, we will add onto it based on what was passed

    if(isset($_POST["userName"])){
        // checks if user name is in database
        if ($result = $conn->query($query)) {
            while ($row = $result->fetch_assoc()) {
                if($name == $row["userName"]){
                    $userMatch = true;
                }
            }
        }
        if (!$userMatch) { //username is available
            if (!$firstUpdate) {
                $sql .= ", "; //need a comma if this is not the first updated column
            }
            $name = $_POST["userName"];
            $sql .= "userName = '$name'";
            $firstUpdate = false;

        }
    }
    if(isset($_POST["passd"]) && isset($_POST["passd2"])){
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

        if (!$unmatched_passwords && !$password_missing_lowercase && !$password_missing_uppercase 
            && !$password_missing_number && !$password_too_short) { //password meets criteria
            if (!$firstUpdate) {
                $sql .= ", "; //need a comma if this is not the first updated column
            }
            $passd = $_POST["passd"];
            $sql .= "passd = '$passd'";
            $firstUpdate = false;
        }
    }
    if(isset($_POST["firstName"])){
        // checks if first name contains special characters
        if(preg_match('/[^a-zA-Z]/', $firstName) == true){
            $names_contain_non_letters = true;
        }
        if (!$names_contain_non_letters) { //name meets criteria
            if (!$firstUpdate) {
                $sql .= ", "; //need a comma if this is not the first updated column
            }
            $firstName = $_POST["firstName"];
            $sql .= "firstName = '$firstName'";
            $firstUpdate = false;
        }
    }
    if(isset($_POST["lastName"])){
        // checks if last name contains special characters
        if(preg_match('/[^a-zA-Z]/', $lastName) == true){
            $names_contain_non_letters = true;
        }
        if (!$names_contain_non_letters) { //name meets criteria
            if (!$firstUpdate) {
                $sql .= ", "; //need a comma if this is not the first updated column
            }
            $lastName = $_POST["lastName"];
            $sql .= "lastName = '$lastName'";
            $firstUpdate = false;
        }
    }
    /*  changing emails is disabled since I'm not sure how to do email reverification
    if(isset($_POST["email"])){
        // check if email is in use
        if ($result = $conn->query($query)) {
            while ($row = $result->fetch_assoc()) {
                if($email == $row["email"]){
                    $emailMatch = true;
                }
            }
        }
        // check email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $invalid_email = true;
        }
        if (!$emailMatch && !$invalid_email) { //email is available and passes filter
            if (!$firstUpdate) {
                $sql .= ", "; //need a comma if this is not the first updated column
            }
            $email = $_POST["email"];
            $sql .= "email = $email";
            $firstUpdate = false;

        }
    }
    */
    if(isset($_POST["bio"])){
        if (!$firstUpdate) {
            $sql .= ", "; //need a comma if this is not the first updated column
        }
        $bio = $_POST["bio"];
        $sql .= "bio = '$bio'";
        $firstUpdate = false;
    }

    if ($userMatch == true) {
        $error_header .= "error=username_exists";
        header($error_header);
        exit();
    }

    else if ($unmatched_passwords == true) {
        $error_header .= "error=unmatched_passwords";
        header($error_header);
        exit();
    }

    else if ($password_missing_lowercase == true) {
        $error_header .= "error=password_missing_lowercase";
        header($error_header);
        exit();
    }

    else if ($password_missing_uppercase == true) {
        $error_header .= "error=password_missing_uppercase";
        header($error_header);
        exit();
    }

    else if ($password_missing_number == true) {
        $error_header .= "error=password_missing_number";
        header($error_header);
        exit();
    }

    else if ($password_too_short == true) {
        $error_header .= "error=password_too_short";
        header($error_header);
        exit();
    }

    else if ($emailMatch == true) {
        $error_header .= "error=emailMatch";
        header($error_header);
        exit();
    }

    else if ($names_contain_non_letters == true) {
        $error_header .= "error=names_contain_non_letters";
        header($error_header);
        exit();
    }

    else if ($invalid_email == true) {
        $error_header .= "error=invalid_email";
        header($error_header);
        exit();
    }

    else{
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
      
        // $hashed_password = password_hash($passd, PASSWORD_DEFAULT);

        if ($conn->query($sql) === TRUE) {
            header("location: ../profile.php");
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