<?php
session_start();
include "db_conn.php";

$data = $_POST['dataInput'];
$id = $_SESSION['Id'];

    if($stmt = $conn->prepare('SELECT Utente_Id, Data FROM preferito WHERE Utente_Id = ? AND Data = ?')){
        $stmt->bind_param('ss', $_SESSION['Id'], $data);
        $stmt->execute();
        $stmt->store_result();
    
        if($stmt->num_rows>0){
    
            if($stmt = $conn->prepare('DELETE FROM preferito WHERE Utente_Id = ? AND Data = ?')){
                
                $stmt->bind_param('ss',  $_SESSION['Id'], $data);
                $stmt->execute();
    
                header("Location: favorite.php?error=Foto Rimossa con successo!");
                exit();
            }
        }
        $stmt->close();
    
    }else{
        header("Location: home.php?=error= ERRORE");
        exit();
    }

?>