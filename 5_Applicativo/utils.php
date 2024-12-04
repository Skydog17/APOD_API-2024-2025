<?php
include "db_conn.php";

//True vuol dire che bisogna aggiungere, false rimuovere
function isInPreferiti($data){
    $conn = getConn();
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
?>