<?php
session_start();
include "db_conn.php";

$id = $_SESSION['Id'];

if($stmt = $conn->prepare('SELECT * FROM cronologia WHERE Id_Utente = ? AND Data = ?')){
    $stmt->bind_param('ss', $id, $data);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows>0){

        header("Location: home.php?error=Foto già messa nei preferiti");
        exit();
    }
    else{
        if($stmt = $conn->prepare('INSERT INTO preferito VALUE(?, ?, ?, ?, ?)')){

            $stmt->bind_param('sssss', $data, $_SESSION['Id'], $url, $titolo, $desc);
            $stmt->execute();

            header("Location: home.php?data=".$data);
            exit();
        }
    }
    $stmt->close();

}else{
    header("Location: home.php?=error= ERRORE");
    exit();
}

?>
