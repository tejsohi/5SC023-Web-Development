<?php
function emptyInputSignup($name, $email, $username, $password, $passwordRepeat) {
    $result = null;
    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($passwordRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUserId($username) {
    $result = null;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result = null;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;

}

function passwordMatch($password, $passwordRepeat) {
    $result = null;
    if ($password !== $passwordRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function usernameExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup/signup.php?error=stmtfailed");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $password) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPassword) VALUES(?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup/signup.php?error=stmtfailed");
        header("location: ");
        exit();
    } 

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signup/signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $password) {
    $result = null;
    if (empty($username) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $password) {
    $userIdExists = usernameExists($conn, $username, $username);

    if ($userIdExists === false) {
        header("location: ../login/login.php?error=wronglogin");
        exit();
    }

    $passwordHashed = $userIdExists["usersPassword"];
    $checkPassword = password_verify($password, $passwordHashed);

    if($checkPassword === false) {
        header("location: ../login/login.php?error=wronglogin");
        exit();
    } else if ($checkPassword === true) {
        session_start();
        $_SESSION["userid"] = $userIdExists["usersId"];
        $_SESSION["useruid"] = $userIdExists["usersUid"];
        header("location: ../../index.php?");
        exit();

    }
    
}
?>
