<?php
    include_once(__DIR__ . "/bootstrap.php");
    require_once(__DIR__ . "/classes/Db.php");
    require_once(__DIR__ . "/classes/Cart.php");
    require_once(__DIR__ . "/classes/User.php");
    require_once(__DIR__ . "/classes/Order.php");

    $conn = \Website\XD\Classes\Db::getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if user is logged in
    if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
        header('Location: login.php');
        exit;
    }

    $email = $_SESSION['email'];

    // Fetch id from the database
    $query = $conn->prepare("SELECT id, credits FROM users WHERE email = ?");
    $query->bindValue(1, $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        $user = $result[0];
        $userId = $user['id'];
        $digitalCredits = $user['credits'];
    } else {
        echo "User not found.";
        exit;
    }
    
    $statement = $conn->prepare("SELECT product_id, quantity, total_price FROM cart WHERE user_id = :user_id");
    $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    //ophalen van producten
    foreach ($result as &$row) {
        $productStatement = $conn->prepare("SELECT title, image FROM products WHERE id = :product_id");
        $productStatement->bindValue(':product_id', $row['product_id'], PDO::PARAM_INT);
        $productStatement->execute();
        $product = $productStatement->fetch(PDO::FETCH_ASSOC);
        $row['product_title'] = $product['title'];
        $row['product_image'] = $product['image'];
    }
    unset($row); // Break the reference with the last element

    $totalQuantity = 0;
    $totalPrice = 0.0;

    //optellen van prijs en hoeveelheid
    foreach ($result as $row) {
        $totalQuantity += $row['quantity'];
        $totalPrice += $row['total_price'];
    }

    //delete producten van cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product_id'])) {
        $productIdToDelete = $_POST['delete_product_id'];
        \Website\XD\Classes\Cart::deleteFromCart($userId, $productIdToDelete);
    }

    //producten bestellen met $digitalCredits, gebruiken van class Order.php functie placeOrder en addOrderItems
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
        $date = date('Y-m-d H:i:s');
        $order = new \Website\XD\Classes\Order();
        $order->placeOrder($date, $userId, $totalPrice, $totalQuantity);
        $order_id = $conn->lastInsertId();
        foreach ($result as $row) {
            $order->addOrderItems($order_id, $row['product_id'], $row['quantity']);
        }
        $newDigitalCredits = $digitalCredits - $totalPrice;
        $user = new \Website\XD\Classes\User();
        $user->setCredits($newDigitalCredits);
        $user->updateCredits($userId, $newDigitalCredits);
        header('Location: winkelmand.php');
    }

    
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelmand</title>
    <link rel="stylesheet" href="css/style.index.css">
    <link rel="stylesheet" href="css/style.producten.css">
    <link rel="stylesheet" href="css/style.winkelmand.css">
</head>
<body>
    <?php include_once("nav.inc.php");?>
    <h1>Winkelmand</h1>

    <?php
        if (count($result) > 0) {
            echo "<table>";
            echo "<tr><th>Image</th><th>Product</th><th>Quantity</th><th>Price</th><th>Delete</th></tr>";
            echo "<tbody class='cartProducts'>";
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td><img class='imageCart' src='./" . htmlspecialchars($row['product_image']) . "' alt='" . htmlspecialchars($row['product_title']) . "' width='50'></td>";
                echo "<td>" . htmlspecialchars($row['product_title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                echo "<td> € " . htmlspecialchars($row['total_price']) . "</td>";
                echo "<td>
                        <form method='POST' action='#'>
                            <input type='hidden' name='delete_product_id' value='" . htmlspecialchars($row['product_id']) . "'>
                            <button type='submit'>delete</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "<tfoot class='totaal'>";
                echo "<tr>";
                echo "<td><strong>Totaal</strong></td>";
                echo "<td></td>";
                echo "<td><strong>" . htmlspecialchars($totalQuantity) . "</strong></td>";
                echo "<td><strong> € " . htmlspecialchars($totalPrice) . "</strong></td>";
                echo "<td></td>";
                echo "</tr>";
            echo "</tfoot>";
            echo "</table>";
            echo "<form method='POST' action=''>";
            echo "<button type='submit' name='place_order'>Bestellen</button>";
            echo "</form>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }
    ?>
</body>
</html>