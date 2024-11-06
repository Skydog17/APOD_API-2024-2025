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
                    <button>Preferiti</button><br><br>
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
            <!--<div id="immagini">
                <h1 id="titolo_img"></h1>
                <h3 id="data_immagine"></h3>
                <img class="smallerImg" id="immagine-1" onclick="aprImmagine('-1')">
                <img id="immagine">
                <img class="smallerImg" id="immagine1" onclick="aprImmagine('1')">
            </div>-->

            <div id="immagini">
                <h1 id="titolo_img"></h1>
                <h3 id="data_immagine"></h3>

                <div class="columnL">

                    <img 
                    class="smallerImg" 
                    id="immagine-1" 
                    onclick="aprImmagine('-1')"
                    >

                    <iframe 
                    id="iframe-1"
                    class="smallerImg" 
                    onclick="aprImmagine('-1')"
                    width="0" 
                    height="0"
                    ></iframe>

                </div>

                <div class="columnC">

                    <img id="immagine">

                    <iframe 
                    id="iframe"
                    width="0" 
                    height="0"
                    ></iframe>

                </div>

                <div class="columnR">
                    <img 
                    class="smallerImg" 
                    id="immagine1" 
                    onclick="aprImmagine('1')"
                    >

                    <iframe 
                    id="iframe1"
                    class="smallerImg" 
                    onclick="aprImmagine('1')"
                    width="0" 
                    height="0"
                    ></iframe>

                </div>

                <div id="desc">
                    <div id="descrizione">
                        <p id="descrizione_immagine"></p>
                    </div>
                </div>
            </div>

            <footer>
                <hr>
                <h2><a onclick="aprImmagine(-1)">&#8592;</a> | Astronomy Picture of the day - Kamil Siddiqui - I3AC | <a onclick="richiesta('')">Pic of Today</a> | <button onclick="apriFiltro()">Search</button> | <a onclick="aprImmagine(1)">&#8594;</a></h2>
                <div id="filtro">
                    <p>Inserire la data con il seguente formato:<br> yyyy-mm-dd</p>
                    <label>Data <label><input type='text' id='dataFiltro'><button onclick="avviaRicerca()">Cerca</button>
                    <br><br>
                </div>
            </footer>
        </div>
    </body>
</html>