<?php
  include_once(__DIR__ . '/bootstrap.php');
  include_once(__DIR__ . '/classes/Db.php');
  include_once(__DIR__ . '/classes/User.php');
  
  // create a new PDO connection using the Db class
  $conn = \Website\XD\Classes\Db::getConnection();
  $statement = $conn->prepare("SELECT * FROM products");
  $statement->execute();
  $products = $statement->fetchAll(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn producten</title>
    <link rel="stylesheet" href="css/style.login.css">
    <link rel="stylesheet" href="css/style.nav.admin.css">
    <link rel="stylesheet" href="css/style.producten.css">
    <link rel="stylesheet" href="css/style.admin.css">
</head>
<body>
  <?php include_once("admin.nav.inc.php");?>
  <div class="container">
      <?php foreach($products as $product):
          echo '<div class="article">';
          echo '<img class="foto" id="image-' . '" src="./' . $product["image"] . '" alt="' . $product["title"] . '">';
          echo '<h2>' . $product["title"] . '</h2>';
          echo '<p>Price: €' . $product["price"] . '</p>';
          echo '<a href="admin.bewerken.php?id=' . $product["id"] . '"><button><img class="bewerken" src="./images/bewerken.png" alt="Bewerken"></button></a>';
          echo '<a href="delete.php?id=' . $product["id"] . '"><button><img class="delete" src="./images/delete.png" alt="Verwijder"></button></a>';
          echo '</div>';
      ?>  
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>