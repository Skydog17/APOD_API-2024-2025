<?php
session_start();
include "db_conn.php";

if(isset($_POST['uname']) && isset($_POST['password'])) {

    function convalida($data){
        $data = trim($data); //Rimuove eventuali spazi all'inizio e alla fine
        $data = stripslashes($data); //Toglie eventuali slash
        $data = htmlspecialchars($data); //Rimuove caratteri speciali
        return $data;
    }
}

$username = convalida($_POST['uname']);
$pass = convalida($_POST['password']);

//CONTROLLO CHE USERNAME E PASSWORD NON SIANO VUOTI; IN CASO DISPLAY UN ERRORE
if(empty($username)){
    header("Location: index.php?error=Username è richiesto");
    exit();
}

else if(empty($pass)){
    header("Location: index.php?error=Password è richiesta");
    exit();
}

$sql = "SELECT * FROM utente WHERE Username='$username' AND  Password=PASSWORD('$pass')"; //QUERY DA FARE AL DATABASE
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['Username'] === $username){ //Se password e nome utente sono IDENTICI a $pass  $uname
        echo "Login effetuato con successo!";
        $_SESSION['Username'] = $row['Username'];
        $_SESSION['Password'] = $row['Password'];
        $_SESSION['Id'] = $row['Id'];
        header("Location: home.php");
        exit();
    }
    else{
        header("Location: index.php?error=Password errata ");
        exit();
    }
}
else{
    header("Location: index.php?error=Username o password errata");
    exit();
}
