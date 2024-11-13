<?php
    //zijn de inlog gegevens oke
    session_start();
    if($_SESSION['loggedin'] !== true){
        header('Location: login.php');
    }

    $conn = new PDO('mysql:dbname=webshop;host=localhost', "root", "");