<?php
    //zijn de inlog gegevens oke
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: login.php");
        exit;
    }    

   //include autoload
   //include_once(__DIR__ . '/vendor/autoload.php');