<?php

$sname = "localhost";
$user = "root";
$password = "";
$dbName = "APOD";

$conn = mysqli_connect($sname, $user, $password, $dbName);
if(!$conn){
    echo "Connessione fallita";
    exit();
}
?>