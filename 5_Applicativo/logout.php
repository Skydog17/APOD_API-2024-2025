<?php

session_unset(); 
//libera tutte le variabili di sessione attualmente registrate.

session_destroy();

header("Location: index.php");
?>