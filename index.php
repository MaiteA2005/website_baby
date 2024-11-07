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

  //<img src="images/<?= $product['image']" vraagteken> alt="<?= $product['name'] vraagteken> ">
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
    <ul>
      <li><a href="index.php" class='nav_text'>Home</a></li>
      <li>
      <div class="dropdown">
      <a href="" class='nav_text'> Categoriën </a>
      <ul class="dropdown-menu">
        <li><a href="kleren.php" class="dropdown-item">Kleren</a></li>
        <li><a href="speelgoed.php" class="dropdown-item" >Speelgoed</a></li>
        <li><a href="eten&drinken.php" class="dropdown-item" >Eten en drinken</a></li>
        <li><a href="slaaphulpjes.php" class="dropdown-item" >Slaaphulpjes</a></li>
      </ul>
    </div></li>
    <div class="icons"></div>
      <li><a href="zoeken.php"><img src="./images/zoeken.png" alt="Zoeken" ></a></li>
      <li><a href=""><img src="./images/digital_currency.png" alt="Digital currency"></a></li>
      <li><a href=""><img src="./images/heart_not_clicked.png" alt="Favorieten"></a></li>
      <li><a href=""><img src="./images/shopping-cart.png" alt="Winkelmand"></a></li>
      <li><a href="profiel.php"><img src="./images/user.png" alt="Profiel"></a></li>
    </div>
    </ul>
  </nav>
  
  <div class="container">
    <h1>Producten</h1>
    <div class="products">
      <?php foreach($products as $product): ?>
        <div class="product">
          
          <h2><?= $product['title'] ?></h2>
          <p><?= $product['description'] ?></p>
          <p>&euro;<?= $product['price'] ?></p>
          <a href="product.php?id=<?= $product['id'] ?>">Bekijk product</a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  
  <footer>
    <p>&copy; 2024 - Maite Aldenkamp - 2XD</p>
  </footer>

</body>
</html>
