<?php
session_start();
include "db_conn.php";

$data = $_POST['dataInput'];
$url = $_POST['url'];
$id = $_SESSION['Id'];

if($stmt = $conn->prepare('SELECT Utente_Id, Data FROM preferito WHERE Utente_Id = ? AND Data = ?')){
    $stmt->bind_param('ss', $_SESSION['Id'], $data);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows>0){

        header("Location: home.php?error=Foto già messa nei preferiti");
        exit();
    }
    else{
        if($stmt = $conn->prepare('INSERT INTO preferito VALUE(?, ?, ?)')){

            $stmt->bind_param('sss', $data, $_SESSION['Id'], $url);
            $stmt->execute();

            header("Location: home.php?Foto aggiunta on successo!");
            exit();
        }
    }
    $stmt->close();

}else{
    header("Location: home.php?=error= ERRORE");
    exit();
}
?>


