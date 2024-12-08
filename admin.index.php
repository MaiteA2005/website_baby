<?php
  include_once(__DIR__ . '/bootstrap.php');
  include_once(__DIR__ . '/classes/Db.php');
  include_once(__DIR__ . '/classes/User.php');

  // create a new PDO connection using the Db class
  $conn = \Website\XD\Classes\Db::getConnection();

  // Check if a delete request has been made
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
      $deleteId = $_POST['delete_id'];
      $deleteStatement = $conn->prepare("DELETE FROM products WHERE id = :id");
      $deleteStatement->bindParam(':id', $deleteId, PDO::PARAM_INT);
      $deleteStatement->execute();
  }

  $statement = $conn->prepare("SELECT * FROM products");
  $statement->execute();
  $products = $statement->fetchAll(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/style.login.css">
    <link rel="stylesheet" href="css/style.producten.css">
    <link rel="stylesheet" href="css/style.admin.css">
</head>
<body>
  <?php include_once("admin.nav.inc.php");?>
  <div class="container">
      <?php foreach($products as $product): ?>
          <div class="article">
              <img class="foto" id="image-<?php echo $product["id"]; ?>" src="./<?php echo $product["image"]; ?>" alt="<?php echo $product["title"]; ?>">
              <h2><?php echo $product["title"]; ?></h2>
              <p>Price: €<?php echo $product["price"]; ?></p></br>
              <a href="admin.bewerken.php?id=<?php echo $product["id"]; ?>"><button><img class="bewerken" src="./images/bewerken.png" alt="Bewerken"></button></a>
              <form method="POST" action="" style="display:inline;">
                  <input type="hidden" name="delete_id" value="<?php echo $product["id"]; ?>">
                  <button type="submit"><img class="delete" src="./images/delete.png" alt="Verwijder"></button>
              </form>
          </div>
      <?php endforeach; ?>
  </div>

  <footer>
  <a class="terug" href="admin.index.php">Go back</a>
  </footer>
</body>
</html>