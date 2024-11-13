<?php
    //zijn de inlog gegevens oke
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: login.php");
        exit;
    }    

    $conn = new PDO('mysql:dbname=webshop;host=localhost', "root", "");