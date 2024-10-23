<?php
include "db_conn.php";
include "login.php";
$data = date_create();
//INSERT INTO preferito VALUES(Data,ID_utente);
$sql = "INSERT INTO preferito VALUES($data, $_SESSION['Id']);"; //QUERY DA FARE AL DATABASE

header("Location: home.php");
exit();

?>