<?php

if (isset($_POST["submit"])) {
    $username = $_POST["uid"];
    $password = $_POST["password"];



    require_once "../../includes/databaseHandler.php";
    require_once "../../includes/functions.inc.php";


    if(emptyInputLogin($username, $password) !== false) {
        header("location: ./login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $password);

} else {
    header("location: ../login/login.php");
    exit();
}




?>