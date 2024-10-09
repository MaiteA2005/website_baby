<?php
    //uitloggen met cookie
    //setcookie("login", "jrif", time()-3600); //cookie maken in het verleden

    //uitloggen met session
    session_start();
    session_destroy();

    header("Location: login.php"); // redirecten naar login pagina
?>