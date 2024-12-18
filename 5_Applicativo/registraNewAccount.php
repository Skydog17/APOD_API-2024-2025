<?php
    session_start();
    include "db_conn.php";
    include 'utils.php';

    $username = convalida($_POST['uname']);
    $pass = convalida($_POST['password']);
    $rPass = convalida($_POST['repeatP']);
    //CONTROLLO CHE USERNAME E PASSWORD NON SIANO VUOTI; IN CASO DISPLAY UN ERRORE
    if(empty($username)){
        header("Location: register.php?error=Username è richiesto");
        exit();
    }

    else if(empty($pass) || empty($rPass)){
        header("Location: register.php?error=Password è richiesta");
        exit();
    }

    else if($pass!=$rPass){
        header("Location: register.php?error=Password non coincidono");
        exit();
    }

    
        if($stmt = $conn->prepare('SELECT Id, Password FROM utente WHERE Username =?')){
            $stmt->bind_param('s', $_POST['uname']);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows>0){
                header("Location: register.php?error=Username già esistente");
                exit();
            }
            else{

                if($stmt = $conn->prepare('INSERT INTO utente (Username, Password) VALUE(?, ?)')){

                    $password = md5($_POST['password']);
                    $stmt->bind_param('ss', $username, $password);
                    $stmt->execute();

                    $sql = "SELECT * FROM utente WHERE Username='$username' AND  Password='$password'"; //QUERY DA FARE AL DATABASE
                    $result = mysqli_query($conn, $sql);
                    if(gettype($result) == "mysqli_result" || gettype($result) == "object"){
                        $row = mysqli_fetch_assoc($result);
                        echo "Register effetuato con successo!";
                        $_SESSION['Username'] = $row['Username'];
                        $_SESSION['Password'] = $row['Password'];
                        $_SESSION['Id'] = $row['Id'];
                        header("Location: home.php");
                        exit();
                    }
                    else{
                        header("Location: register.php?=error= ERRORE");
                        exit();
                    }
                }
            }
            $stmt->close();
        }
        else{
            header("Location: register.php?=error= ERRORE");
            exit();
        }
    
?>