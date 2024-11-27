<?php 
  include_once(__DIR__ . '/bootstrap.php');
  include_once(__DIR__ . '/classes/Db.php');
  
  // create a new PDO connection using the Db class
  $conn = \Website\XD\Classes\Db::getConnection();
  $statement = $conn->prepare("SELECT * FROM products");
  $statement->execute();
  $products = $statement->fetchAll(PDO::FETCH_ASSOC);
  
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Webshop 2XD</title>
  <link rel="stylesheet" href="css/style.index.css">
  <link rel="stylesheet" href="css/style.producten.css">
</head>
<body>
  <?php include_once("nav.inc.php");?>

  <div class="container">
      <?php foreach($products as $product):
          echo '<div class="article">';
          echo '<img class="foto" id="image-' . '" src="./' . $product["image"] . '" alt="' . $product["title"] . '">';
          echo '<h2>' . $product["title"] . '</h2>';
          echo '<p>Price: €' . $product["price"] . '</p>';
          echo '</br><button>Add to favorites</button>';
          echo '</br><button>Add to cart</button>';
          echo '</br><form action="details.php" method="GET">';
          echo '<input type="hidden" name="id" value="' . $product["id"] . '">';
          echo '<button type="submit">View Details</button>';
          echo '</form>';
          echo '</div>';
      ?>  
      <?php endforeach; ?>
    </div>
  </div>

  <footer>
    <a class="terug" href="index.php">Go back</a>
  </footer>

</body>
</html>
