<?php

if(isset($_POST["submit"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["userid"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordrepeat"];

    require_once '../../includes/databaseHandler.php'; 
    require_once '../../includes/functions.inc.php';

    
    if(emptyInputSignup($name, $email, $username, $password, $passwordRepeat) !== false) {
        header("location: ./signup.php?error=emptyinput");
        exit();
    }

    if(invalidUserId($username) !== false) {
        header("location: ./signup.php?error=invalidUserId");
        exit();
    }

    if(invalidEmail($email) !== false) {
        header("location: ./signup.php?error=invalidEmail");
        exit();
    }

    if(passwordMatch($password, $passwordRepeat) !== false) {
        header("location: ./signup.php?error=passwordsDontMatch");
        exit();
    }

    if(usernameExists($conn, $username, $email) !== false) {
        header("location: ./signup.php?error=usernameTaken");
        exit();
    }

    createUser($conn, $name, $email, $username, $password);




} else {
    header("location: ../signup/signup.php");
    exit();
}

?>