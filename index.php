<?php 
  //'mysql:dbname=testdb;host=127.0.0.1'
  //PDO connection
  $conn = new PDO('mysql:dbname=webshop;host=localhost', "root", "");

  //databank connecten
  //$conn = new mysqli('localhost' , 'root' , '' , 'webshop');

  //select * from prod
  $statement = $conn->prepare("SELECT * FROM products");
  $statement->execute();
  $products = $statement->fetchAll(PDO::FETCH_ASSOC);

  //zijn de inlog gegevens oke
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
  <link rel="stylesheet" href="css/stylesheet.index.css">
</head>
<body>
<nav>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropbtn">categoriën</a>
      <div class="dropdown-content">
      <a href="#">Category 1</a>
      <a href="#">Category 2</a>
      <a href="#">Category 3</a>
      </div>
    </li>
    <li><a href="">Zoeken</a></li>
    <li><a href="">Digital currency</a></li>
    <li><a href="">Favorieten</a></li>
    <li><a href="">Winkelmand</a></li>
    <li><a href="">Profiel</a></li>
  </ul>
</nav>

  <div class="collection">
    <h1>Webshop</h1>
    <a href="logout.php" class="navbar__logout">Hi Stranger, logout?</a>
  </div>
  <?php foreach($products as $product): ?>
  <article>
    <h1><?php echo $product['title']?> : €<?php echo $product['price']?></h1>
  </article>
  <?php endforeach ?>  

</body>
</html>
