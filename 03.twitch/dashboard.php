<?php
    session_start();
    if(isset($_SESSION['username'])){
        //user loged in
        echo "Welcome " . $_SESSION["username"];
        //queries
    }else{
        header("Location: login.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>