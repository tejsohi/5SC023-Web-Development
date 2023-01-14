<?php

$serverName = "localhost";
$dbUsername = "1926434";
$dbPassword = "6ab25p";
$dbName = "db1926434";



$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}






?>