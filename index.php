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


  //$result = $conn->query("SELECT * FROM products");
  //$products = $result->fetch_all(MYSQLI_ASSOC);
  //var_dump($products);

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
  <?php foreach($products as $product): ?>
  <article>
    <h1><?php echo $product['title']?> : €<?php echo $product['price']?></h1>
  </article>
  <?php endforeach ?>  

</body>
</html>
