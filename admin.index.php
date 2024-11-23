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
</head>
<body>
  <nav>
    <ul>
      <li><a href="admin.index.php" class='nav_text'>Home</a></li>
      <li>
      <div class="dropdown">
      <a href="" class='nav_text'> Producten </a>
      <ul class="dropdown-menu">
        <li><a href="admin.dashboard.php" class="dropdown-item">Toevoegen</a></li>
        <li><a href="" class="dropdown-item" >Verwijderen of bewerken</a></li>
      </ul>
    </div></li>
    <div class="icons"></div>
        <li><a href="admin.dashboard.php"><img class="icon" src="./images/add.png" alt="Toevoegen" ></a></li>
        <li><a href=""><img class="icon" src="./images/bewerken.png" alt="Bewerken"></a></li>
        <li><a href=""><img class="icon" src="./images/delete.png" alt="Verwijder"></a></li>
        <li><a href="profiel.php"><img class="icon" src="./images/user.png" alt="Profiel"></a></li>
    </div>
    </ul>
  </nav>
    
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
</body>
</html>