<?php

$sname = "localhost";
$user = "root";
$password = "";
$dbName = "APOD";

$conn = mysqli_connect($sname, $user, $password, $dbName);
if(!$conn){
    exit("Errore el connettersi al database");
}

/*function getConn(){
    $sname = "localhost";
    $user = "root";
    $password = "";
    $dbName = "APOD";
    $conn = mysqli_connect($sname, $user, $password, $dbName);
    if(!$conn){
        exit("Errore el connettersi al database");
    }
    return $conn;
}*/
?>