<?php 
  include_once(__DIR__ . "/bootstrap.php");
  require_once(__DIR__ . "/classes/User.php");
  require_once(__DIR__ . "/classes/Db.php");
  require_once(__DIR__ . "/classes/Cart.php");

  // create a new PDO connection using the Db class
  $conn = \Website\XD\Classes\Db::getConnection();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Check if user is logged in
  if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('Location: login.php');
    exit;
  }

  $statement = $conn->prepare("SELECT * FROM products");
  $statement->execute();
  $products = $statement->fetchAll(PDO::FETCH_ASSOC);

  
  $email = $_SESSION['email'];

  // Fetch id from the database
  $query = $conn->prepare("SELECT id FROM users WHERE email = ?");
  $query->bindValue(1, $email, PDO::PARAM_STR);
  $query->execute();
  $result = $query->fetchAll(PDO::FETCH_ASSOC);

  if (count($result) > 0) {
      $user = $result[0];
      $userId = $user['id'];
  } else {
      echo "User not found.";
      exit;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productQuantity = 1; // Default quantity to add

    // Fetch product details
    $statement = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $statement->bindParam(':id', $productId, PDO::PARAM_INT);
    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $total = $product["price"];
        \Website\XD\Classes\Cart::addToCart($userId, $productId, $productQuantity, $total);

        header("Location: winkelmand.php");
        exit();
    } else {
        echo "Product not found.";
    }

  }
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
    <?php foreach($products as $product): ?>
      <div class="article">
        <img class="foto" id="image-<?php echo $product["id"]; ?>" src="./<?php echo $product["image"]; ?>" alt="<?php echo $product["title"]; ?>">
        <h2><?php echo $product["title"]; ?></h2>
        <p>Price: €<?php echo $product["price"]; ?></p></br>
        <form method="POST" action="">
          <input type="hidden" name="product_id" value="<?php echo $product["id"]; ?>">
          <button type="submit" name="add_to_cart">Add to cart</button>
        </form>
        <form action="details.php" method="GET">
          <input type="hidden" name="id" value="<?php echo $product["id"]; ?>">
          <button type="submit">View Details</button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>

  <footer>
  <a class="terug" href="index.php">Go back</a>
  </footer>

</body>
</html>
