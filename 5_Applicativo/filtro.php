<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="APOD by Kamil Siddiqui">
        <meta name="author" content="Kamil Siddiqui">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Astronomy Picture of the Day</title>
        <script src="js/format.js"></script>    <!-- Javascript dedicato alla gestione della formatazione della page-->
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div id="contenitore">
            <header>
                <button id="apriMenu" onclick="openMenu()">Menu</button>
                <div id="menu">
<?php
    session_start();
    if(isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
?>
                    <a href="logout.php"><button>Logout</button></a><br><br>
                    <a href="home.php"><button>Home</button></a><br><br>
                    <a href="favorite.php"><button>Preferiti</button></a><br><br>
                    <a href="history.php"><button>Cronologia</button></a><br>
                </div>
                <h1 class="title">Astronomy Picture of the day</h1>
                <h2 class="title">Ciao <?php echo $_SESSION['Username']; ?>,<br>scopri il cosmo!</h2>
                <hr>
            </header>
<?php
}
else{
?>
                    <a href="index.php"><button>Login</button></a><br><br>
                    <a href="home.php"><button>Home</button></a><br><br>
                    <h4>Per vedere Preferiti e<br> Cronologia, effettua il login!<h4>
                </div>
                <h1 class="title">Astronomy Picture of the day</h1>
                <h2 class="title">Effettua il login e scopri il cosmo!</h2>
                <hr>
            </header>
<?php
}
?>
            <center>
                <div>
                    <h2>Inserisci la data da cercare, deve essere in questo range di date:<br>16.06.1995 - Oggi<br>ATTENZIONE, nel 1995 non tutti i giorni avevano una foto</h2>
                    
                    <form action="filtro.php" method="post">
                       <br><input type='date' id='dataFiltro' name='dataFiltro'><br>
                       <input type="text" id="urlFiltro" name="url" value=" " style="visibility:hidden;">
                        <input type="text" id="dataFiltroInput" name="dataInput" value=" " style="visibility:hidden;">
                        <input type="text" id="titoloFiltroInput" name="titoloInput" value=" " style="visibility:hidden;">
                        <input type="text" id="descFiltroInput" name="descInput" value=" " style="visibility:hidden;"><br>
                        <input type="text" id="valid" name="valid" value="true" style="visibility:hidden;"><br>
                        <button id="btnFiltro" name='btnFiltro' onclick="changeFiltro()" type="submit"  >Cerca</button>
                    </form>

                    <br><br>
                </div>
            </center>

            <?php
                if(isset($_POST['btnFiltro'])){
                    if($_POST['valid']=="true"){
                        require 'db_conn.php';
                        $data = $_POST['dataFiltro'];
                        setcookie('date', $data, time() + 5, '/');
                        $_COOKIE['date'] = $data;
    
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
                        
                        
                        header("Location: home.php");
                    }
                    else{
                        header("Location: filtro.php");
                        exit();
                    }
                }
                    
            ?>

            <footer>
                <hr>
                <h2>Astronomy Picture of the day - Kamil Siddiqui - I3AC</a></h2>
            </footer>
        </div>
    </body>
</html>