
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
                <h1 class="title">Astronomy Picture of the day</h1>
                <h2 class="title">Registrati e scopri il cosmo!</h2>
                <hr>
            </header>

            <div id="container">
                <div id ="login">
                    <form action="register.php" method="post">
                        <label>Username</label>
                        <input type="text" placeholder="Enter Username" name="uname">
                        <br><br>
                        <label>Password</label>
                        <input type="password" placeholder="Enter Password" name="password">
                        <br><br>
                        <label>Ripeti password</label>
                        <input type="password" placeholder="Enter Password again" name="repeatP">
                        <br><br>
                        
                        <!-- QUESTA SEZIONE SERVE PER UN EVENTUALE DISPLAY DEGLI ERRORI -->
                        <?php if(isset($_GET['error'])) { ?>
                            <p class="error"> <?php echo $_GET['error'];?></p>
                        <?php } ?> 

                        <button id="btnRegister" type="submit">Registrati</button><br><br>
                    </form>  
                </div>
                
                <h2>Oppure</h2>

                <form action="index.php" method="post" id="login">
                    <button id="btnLogin" type="submit">Torna al login</button><br><br>
                </form> 

                <br>
            <div>
            <footer>
                <hr>
                <h2>Astronomy Picture of the day - Kamil Siddiqui - I3AC</h2>
            </footer>
        </div>

        <?php
            session_start();
            include "db_conn.php";
            include 'utils.php';

        if(isset($_POST['btnRegister'])){

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

                        $row = mysqli_fetch_assoc($result);
                        echo "Register effetuato con successo!";
                        $_SESSION['Username'] = $row['Username'];
                        $_SESSION['Password'] = $row['Password'];
                        $_SESSION['Id'] = $row['Id'];
                        header("Location: home.php");
                        exit();
                    }
                }
                $stmt->close();
            }
            else{
                header("Location: register.php?=error= ERRORE");
                exit();
            }
        }
        ?>
    </body>
</html>