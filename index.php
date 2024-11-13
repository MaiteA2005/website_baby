<?php 
  include_once(__DIR__ . '/bootstrap.php');
  
  $statement = $conn->prepare("SELECT * FROM products");
  $statement->execute();
  $products = $statement->fetchAll(PDO::FETCH_ASSOC);
  
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Webshop 2XD</title>
  <link rel="stylesheet" href="css/stylesheet.css">
  <link rel="stylesheet" href="css/style.index.css">
  <link rel="stylesheet" href="css/style.producten.css">
</head>
<body>
  <?php include_once("nav.inc.php");?>
  
  <h1>Producten</h1>
  <div class="container">
      <?php foreach($products as $product):
          echo '<div class="article">';
          echo '<img class="foto" id="image-' . '" src="./' . $product["image"] . '" alt="' . $product["title"] . '">';
          echo '<h2>' . $product["title"] . '</h2>';
          echo '<p>Price: €' . $product["price"] . '</p>';
          echo '</br><button>Add to favorites</button>';
          echo '</br><button>Add to cart</button>';
          echo '</br><button>View Details</button>';
          echo '</div>';
      ?>  
      <?php endforeach; ?>
    </div>
  </div>
  
  <footer>
    <p>&copy; 2024 - Maite Aldenkamp - 2XD</p>
  </footer>

</body>
</html>
