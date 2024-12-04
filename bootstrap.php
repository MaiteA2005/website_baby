<?php
//zijn de inlog gegevens oke
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

//include autoload
//require_once(__DIR__ . '/../vendor/autoload.php');

//autoload classes
