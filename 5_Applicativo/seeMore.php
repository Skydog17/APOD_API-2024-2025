<?php
                    $data = $_POST['dateDesc'];
                    setcookie('date', $data, time() + 5, '/');
                    $_COOKIE['date'] = $data;
                    header("Location: home.php");
                    echo $data;
                    exit();
?>