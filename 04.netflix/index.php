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

  include_once("data.inc.php");

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>IMDFlix</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  
  <div id="netflix">
  
  <?php include_once("nav.inc.php"); ?>
  
  <div class="collection">
    
    <?php foreach($collection as $key => $c): ?>
    <a href="details.php?id=<?php echo $key ?>" class="collection__item" style="background-image: url('<?php echo $c['poster']?>')">
    </a>
    <?php endforeach;  ?>
  </div>
  
</div>

</body>
</html>
