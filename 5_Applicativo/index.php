<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="APOD by Kamil Siddiqui">
        <meta name="author" content="Kamil Siddiqui">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <script src="js/format.js"></script>    <!-- Javascript dedicato alla gestione della formatazione della page-->
        <script src="js/api.js"></script>       <!-- Javascript dedicato alla gestione dell'API-->
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div id="contenitore">
            <header>
                <button id="apriMenu" onclick="openMenu()">Menu</button>
                <div id="menu">
                    <a href="home.php"><button>Home</button></a><br><br>
                    <button>Preferiti</button><br><br>
                    <button>Cronologia</button>
                </div>
                <h1 class="title">Astronomy Picture of the day</h1>
                <h2 class="title">Fai il login e scopri il cosmo!</h2>
                <hr>
            </header>

            <div id="container">
                <form action="login.php" method="post" id="login">
                    <label>Username</label>
                    <input type="text" placeholder="Enter Username" name="uname">
                    <br><br>
                    <label>Password</label>
                    <input type="password" placeholder="Enter Password" name="password">
                    <br><br>
                    
                    <!-- QUESTA SEZIONE SERVE PER UN EVENTUALE DISPLAY DEGLI ERRORI -->
                    <?php if(isset($_GET['error'])) { ?>
                        <p class="error"> <?php echo $_GET['error'];?></p>
                    <?php } ?> 

                    <button id="btnLogin" type="submit">Login</button><br><br>
                </form>     
            <div>
            <footer>
                <hr>
                <h2>Astronomy Picture of the day - Kamil Siddiqui - I3AC</h2>
            </footer>
        </div>
    </body>
</html>