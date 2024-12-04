
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="APOD by Kamil Siddiqui">
        <meta name="author" content="Kamil Siddiqui">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Astronomy Picture of the Day</title>
        <script src="js/format.js"></script>    <!-- Javascript dedicato alla gestione della formatazione della page-->
        <script src="js/api.js"></script>       <!-- Javascript dedicato alla gestione dell'API-->
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body onload="richiesta('')">
        <div id="contenitore">
            <header>
                <button id="apriMenu" onclick="openMenu()">Menu</button>
                <div id="menu">
                    <!--<a href="index.php"><button>Login</button></a><br><br>-->
<?php
    session_start();
    if(isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
?>
                    <a href="logout.php"><button>Logout</button></a><br><br>
                    <a href="favorite.php"><button>Preferiti</button></a><br><br>
                    <button>Cronologia</button>
                </div>
                <h1 class="title">Astronomy Picture of the day</h1>
                <h2 class="title">Ciao <?php echo $_SESSION['Username']; ?>,<br>scopri il cosmo!</h2>
                <hr>
            </header>
<?php
}
else{
?>
                    <a href="index.php"><button>Login</button></a><br>
                    <h4>Per vedere Preferiti e Cronologia,<br> effettua il login!<h4>
                </div>
                <h1 class="title">Astronomy Picture of the day</h1>
                <h2 class="title">Effettua il login e scopri il cosmo!</h2>
                <hr>
            </header>
<?php
}
?>

            <div id="immagini">
                <h1 id="titolo_img"></h1>
                <h3 id="data_immagine"></h3>

                <div class="columnL">

                    <img 
                    class="smallerImg" 
                    id="immagine-1" 
                    onclick="aprImmagine(-1)"
                    >

                    <iframe 
                    id="iframe-1"
                    class="smallerImg" 
                    onclick="aprImmagine(-1)"
                    width="0" 
                    height="0"
                    ></iframe>

                </div>

                <div class="columnC">

                    <img id="immagine">                 

                    <iframe id="iframe" 
                    id="iframe"
                    width="0" 
                    height="0"
                    ></iframe>

                    <?php
                        if(isset($_SESSION['Id']) && isset($_SESSION['Username'])) {
                    ?>
                        <form action="addPreferiti.php" method="get">
                            <div id="inputDaNascondere">
                                <input type="text" id="url" name="url" value=" " style="visibility:hidden;">
                                <input type="text" id="dataInput" name="dataInput" value=" " style="visibility:hidden;">
                                <input type="text" id="titoloInput" name="titoloInput" value=" " style="visibility:hidden;">
                                <input type="text" id="descInput" name="descInput" value=" " style="visibility:hidden;">
                            </div>
                            <button id="button_preferito" type="submit">Metti nei preferiti</button><br><br>
                        </form> 
                    <?php
                        }
                    ?>

                </div>

                <div class="columnR">
                    <img 
                    class="smallerImg" 
                    id="immagine1" 
                    onclick="aprImmagine(1)"
                    >

                    <iframe 
                    id="iframe1"
                    class="smallerImg" 
                    width="0" 
                    height="0"
                    ></iframe>

                </div>

                <div id="desc">
                    <div id="descrizione">
                        <p id="descrizione_immagine"></p>
                    </div>
                    <div id="filtro">
                        <p>Inserisci la data da cercare, deve essere in questo range di date:<br>16.06.1995 - Oggi<br>ATTENZIONE, nel 1995 non tutti i giorni avevano una foto</p>
                        <label>Data <label><input type='date' id='dataFiltro'><button onclick="avviaRicerca()">Cerca</button>
                        <br><br>
                    </div>
                </div>
                
            </div>

            <footer>
                <hr>
                <h2><a onclick="aprImmagine(-1)">&#8592;</a> | Astronomy Picture of the day - Kamil Siddiqui - I3AC | <a onclick="richiesta('')">Premimi e guarda la foto di oggi!</a> | <button onclick="apriFiltro()">Search</button> | <a onclick="aprImmagine(1)">&#8594;</a></h2>
            </footer>
        </div>
    </body>
</html>