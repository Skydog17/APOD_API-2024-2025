<?php
    session_start();
    include "db_conn.php";
    include "utils.php";

    $data = convalida($_POST['dataInput']);
    $url = convalida($_POST['url']);
    $id = convalida($_POST['Id']);
    $titolo = convalida($_POST['titoloInput']);
    $desc = convalida($_POST['descInput']);

    if($stmt = $conn->prepare('SELECT Utente_Id, Data FROM preferito WHERE Utente_Id = ? AND Data = ?')){
        $stmt->bind_param('ss', $_SESSION['Id'], $data);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows>0){
            setcookie('date', $data, time() + 5, '/');
            $_COOKIE['date'] = $data;
            header("Location: home.php?error=Foto già messa nei preferiti");
            exit();
        }
        else{
            if($stmt = $conn->prepare('INSERT INTO preferito VALUE(?, ?, ?, ?, ?)')){

                $stmt->bind_param('sssss', $data, $_SESSION['Id'], $url, $titolo, $desc);
                $stmt->execute();

                setcookie('date', $data, time() + 5, '/');
                $_COOKIE['date'] = $data;

                header("Location: home.php?");
                exit();
            }
        }
        $stmt->close();

    }else{
        header("Location: home.php?=error= ERRORE");
        exit();
    }
?>


