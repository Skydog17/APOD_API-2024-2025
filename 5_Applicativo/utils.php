<?php
include "db_conn.php";

//True vuol dire che bisogna aggiungere, false rimuovere
function isInPreferiti($data){
    $conn;
    if($stmt = $conn->prepare('SELECT Utente_Id, Data FROM preferito WHERE Utente_Id = ? AND Data = ?')){
        $stmt->bind_param('ss', $_SESSION['Id'], $data);
        $stmt->execute();
        $stmt->store_result();
    
        if($stmt->num_rows>0){
            return false;
        }
        else{
            return true;
        }
        $stmt->close();
    }
}

function addHistory(){
    //$conn = getConn();
}

function convalida($data){
    $data = trim($data); //Rimuove eventuali spazi all'inizio e alla fine
    $data = stripslashes($data); //Toglie eventuali slash
    $data = htmlspecialchars($data); //Rimuove caratteri speciali
    return $data;
}

function addCronologia(){
session_start();

$data = $_POST['dataInput'];
$id = $_SESSION['Id'];

    if($stmt = $conn->prepare('SELECT Id_Utente, Data FROM cronologia WHERE Id_Utente = ? AND Data = ?')){
        $stmt->bind_param('ss', $_SESSION['Id'], $data);
        $stmt->execute();
        $stmt->store_result();
    
        if($stmt->num_rows>0){
    
            if($stmt = $conn->prepare('DELETE FROM cronologia WHERE Id_Utente = ? AND Data = ?')){
                
                $stmt->bind_param('ss',  $_SESSION['Id'], $data);
                $stmt->execute();
    
                header("Location: history.php?error=Foto Rimossa con successo!");
                exit();
            }
        }
        $stmt->close();
    
    }else{
        header("Location: history.php?=error= ERRORE");
        exit();
    }
}
?>