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
  <link rel="stylesheet" href="css/style.index.css">
</head>
<body>
<nav>
  <h2>Webshop</h2>
  <ul>
    <li><a href="index.php" class='nav_text'>Home</a></li>
    <li>
    <div class="dropdown">
    <a href="" class='nav_text'> Categoriën </a>
    <ul class="dropdown-menu">
      <li><a href="" class="dropdown-item">Kleren</a></li>
      <li><a href="" class="dropdown-item" >Speelgoed</a></li>
      <li><a href="" class="dropdown-item" >Eten en drinken</a></li>
      <li><a href="" class="dropdown-item" >Slaaphulpjes</a></li>
    </ul>
  </div></li>
  <div class="icons"></div>
    <li><a href=""><img src="./images/zoeken.png" alt="Zoeken" ></a></li>
    <li><a href=""><img src="./images/digital_currency.png" alt="Digital currency"></a></li>
    <li><a href=""><img src="./images/heart_not_clicked.png" alt="Favorieten"></a></li>
    <li><a href=""><img src="./images/shopping-cart.png" alt="Winkelmand"></a></li>
    <li><a href=""><img src="./images/user.png" alt="Profiel"></a></li>
  </div>
  </ul>
</nav>
  
  <?php foreach($products as $product): ?>
  <article>
    <h1><?php echo $product['title']?> : €<?php echo $product['price']?></h1>
  </article>
  <?php endforeach ?>  

</body>
</html>
