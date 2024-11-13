<?php
    //zijn de inlog gegevens oke
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: login.php");
        exit;
    }    
<<<<<<< HEAD

   //include autoload
   //include_once(__DIR__ . '/vendor/autoload.php');
=======
>>>>>>> 2006ca7 (update 3 13/11)

   //require_once __DIR__ . '/vendor/autoload.php';