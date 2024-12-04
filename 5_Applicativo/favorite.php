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

    <body>
        <?php
            session_start();
        ?>
        <div id="contenitore">
            <header>
                <button id="apriMenu" onclick="openMenu()">Menu</button>
                <div id="menu">
                    <!--<a href="index.php"><button>Login</button></a><br><br>-->
                    <a href="logout.php"><button>Logout</button></a><br><br>
                    <a href="home.php"><button>Home</button></a><br><br>
                    <button>Cronologia</button>
                </div>
                <h1 class="title">Astronomy Picture of the day</h1>
                <h2 class="title">Ciao <?php echo $_SESSION['Username']; ?>,<br>ecco le tue foto preferite!</h2>
            </header>

            <?php
                include "db_conn.php";
                $id = $_SESSION['Id'];
                $sql = "SELECT * FROM preferito WHERE Utente_Id = '$id'"; //QUERY DA FARE AL DATABASE
                $result = mysqli_query($conn, $sql);
                $media="";
                $css = "style='border: 1px solid white;border-collapse: collapse;padding:10px;'";
                $cssWider = "style='border: 1px solid white;border-collapse: collapse;padding:10px; width:400px;'";
                $cssImg = "style='border: 1px solid white;border-collapse: collapse;'";
                $table ="<center><table ".$css.">
                            <tr>
                                <td ".$css.">Data</td>
                                <td ".$css.">Immagine</td>
                                <td ".$css.">Titolo</td>
                                <td ".$css.">Descrizione</td>
                                <td ".$css.">Delete</td>
                            </tr>";

                if(mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $date = $row['Data'];
                        $url = $row['url'];
                        $titolo = $row['Titolo'];
                        $desc = $row['Descrizione'];
                        if(str_contains($url, "apod.nasa.gov")){
                            $media = "<img src=".$url." style='width:auto;height:auto;border:none;'>";
                        }
                        else{
                            $media = "<iframe src=".$url." style='width:400px;height:250px;border:none;'></iframe>";
                        }
                        $table = $table."<tr>
                                            <th ".$css.">".$date."</th>
                                            <th ".$cssImg.">".$media."</th>
                                            <th ".$css.">".$titolo."</th>
                                            <th ".$cssWider.">".$desc."... <br><a href='home.php'>See more</a></th>
                                            <th ".$css."> 
                                                <form action='removePreferiti.php' method='post'>
                                                    <input type='text' id='dataInput' name='dataInput' value=".$date." style='visibility:hidden;'><br>
                                                    <button id='button_remover' type='submit'>Rimuovi dai preferiti</button><br><br>
                                                </form>
                                            </th>
                                        </tr>";
                       }
                    $table=$table."</table></center>";
                    echo $table;
                }
                else{
                    echo "<hr><br><br><center><h1>Nessuna foto preferita!</h1><center><br><br><hr>";
                }
            ?>

            <footer>
                <h2>Astronomy Picture of the day - Kamil Siddiqui - I3AC</h2>
            </footer>
        </div>
    </body>
</html>