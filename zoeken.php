<?php
    include_once (__DIR__ . '/bootstrap.php');
    require_once(__DIR__ . '/classes/Db.php');
    require_once(__DIR__ . "/classes/Cart.php");

    $conn = \Website\XD\Classes\Db::getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $results = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['search'])) {
        $search = htmlspecialchars($_POST['search']);
        $stmt = $conn->prepare("SELECT * FROM products WHERE title LIKE :search");
        $stmt->execute(['search' => '%' . $search . '%']);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $statement = $conn->prepare("SELECT * FROM products");
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.index.css">
    <link rel="stylesheet" href="css/style.producten.css">
    <link rel="stylesheet" href="css/style.zoeken.css">
    <title>Zoeken</title>
</head>
<body>
    <?php include_once("nav.inc.php");?>
    <h1>Zoeken</h1>
    <div class="container">
        <form method="post" action="">
            <div class="form__field">
                <input class="form__field" type="text" name="search" value="">
                <button type="submit">Zoek</button>
            </div>
        </form>
    </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($results) {
                foreach ($results as $product)  {
                    echo '<div class="article">';
                    echo '<img class="foto" id="image-' . '" src="./' . $product["image"] . '" alt="' . $product["title"] . '">';
                    echo '<h2>' . $product["title"] . '</h2>';
                    echo '<p>Price: €' . $product["price"] . '</p>';
                    echo '<form method="POST" action="">';
                        echo '<input type="hidden" name="product_id" value="' . $product["id"] . '">';
                        echo '<button type="submit" name="add_to_cart">Add to cart</button>';
                    echo '</form>';
                    echo '<form action="details.php" method="GET">';
                        echo '<input type="hidden" name="id" value="' . $product["id"] . '">';
                        echo '<button type="submit">View Details</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "Geen producten gevonden.";
            }
        }
        ?>
    
</body>
</html>