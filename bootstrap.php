<?php
    //zijn de inlog gegevens oke
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: login.php");
        exit;
    }
    else{
        session_start();
		$_SESSION['loggedin'] = true;
		$_SESSION['email'] = $email;
		header ("location: index.php");
    }

    

    $conn = new PDO('mysql:dbname=webshop;host=localhost', "root", "");