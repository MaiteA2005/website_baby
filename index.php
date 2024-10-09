<?php 
  //html = state les onthoud niks
  //php = onthoud

  //zijn de inlog gegevens oke (coookies)
  //check if cookie "login" exists
  //if(!isset($_COOKIE['login'])){
    //else redirect to login.php
    //header("Location: login.php");
  //} else{
    //$cookie = $_COOKIE['login'];
    //$salt = "yt5789HJKJNBVFHKhygLMNO,ejngdhrfjed678";

    //$pieces = explode("," , $cookie);
    //if(md5($pieces[0].$salt) !== $pieces[1]){
      //header('Location: login.php');
    //} 
  //}

  //zijn de inlog gegevens oke (session)
  session_start();
  if($_SESSION['loggedin'] !== true){
    header('Location: login.php');
  }


?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Webshop 2XD</title>
  <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body>

  <div class="collection">
    <h1>Webshop</h1>
    <a href="logout.php" class="navbar__logout">Hi Stranger, logout?</a>
  </div>
</div>

</body>
</html>
