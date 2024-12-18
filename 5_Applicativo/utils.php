<?php
include "db_conn.php";
    function convalida($data){
        $data = trim($data); //Rimuove eventuali spazi all'inizio e alla fine
        $data = stripslashes($data); //Toglie eventuali slash
        $data = htmlspecialchars($data); //Rimuove caratteri speciali
        $data=str_replace("\'","","$data");
        return $data;
    }
?>

