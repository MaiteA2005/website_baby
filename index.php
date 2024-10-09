<?php 
  //zijn de inlog gegevens oke
  session_start();
  if($_SESSION['loggedin'] !== true){
    header('Location: login.php');
  }

  $conn = new mysqli('localhost' , 'root' , '' , 'webshop');
  $sql = "SELECT * FROM products";
  $result = $conn->query($sql);
  $products = $result->fetch_all(MYSQLI_ASSOC);
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
