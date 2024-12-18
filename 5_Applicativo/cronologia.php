<?php
include "db_conn.php";

if(isset($_POST['btnFiltro'])){
    $data = $_GET['dataFiltroInput'];
    $url = $_GET['urlFiltro'];
    $id = $_SESSION['Id'];
    $titolo = $_GET['titoloFiltroInput'];
    $desc = $_GET['descFiltroInput'];

    if($stmt = $conn->prepare('SELECT Id_Utente, Data FROM cronologia WHERE Id_Utente = ? AND Data = ?')){
        $stmt->bind_param('ss', $_SESSION['Id'], $data);
        $stmt->execute();
        $stmt->store_result();
    
        if($stmt->num_rows>0){
            setcookie('date', $data, time() + 5, '/');
            $_COOKIE['date'] = $data;
            header("Location: home.php");
            exit();
        }
        else{
            if($stmt = $conn->prepare('INSERT INTO cronologia (Data, id_Utente, url, Titolo, Descrizione) VALUE(?, ?, ?, ?, ?)')){
    
                $stmt->bind_param('sssss', $data, $_SESSION['Id'], $url, $titolo, $desc);
                $stmt->execute();
    
                setcookie('date', $data, time() + 5, '/');
                $_COOKIE['date'] = $data;
    
                header("Location: home.php");
                exit();
            }
        }
        $stmt->close();
    
    }else{
        header("Location: home.php?=error= ERRORE");
        exit();
    }
}

?>
