<?php
    include_once(__DIR__ . "/bootstrap.php");
    require_once(__DIR__ . "/classes/Db.php");
    require_once(__DIR__ . "/classes/Cart.php");
    require_once(__DIR__ . "/classes/User.php");

    $conn = \Website\XD\Classes\Db::getConnection();
    $id=\Website\XD\Classes\User::isLoggedIn();
    $userId = \Website\XD\Classes\User::getUserId($id);
    
    $statement = $conn->prepare("SELECT product_id, quantity, total_price FROM cart WHERE user_id = :user_id");
    $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

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

    foreach ($result as $row) {
        $totalQuantity += $row['quantity'];
        $totalPrice += $row['total_price'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product_id'])) {
        $productIdToDelete = $_POST['delete_product_id'];
        \Website\XD\Classes\Cart::deleteFromCart($userId, $productIdToDelete);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
        $totalAmount = 0.0;
        foreach ($result as $row) {
            $totalAmount += $row['total_price'];
        }

        $userQuery = "SELECT credits FROM users WHERE id = :user_id";
        $stmt = $conn->prepare($userQuery);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['credits'] >= $totalAmount) {
            $orderQuery = "INSERT INTO orders (user_id, total_amount, order_date) VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($orderQuery);
            $stmt->bindValue(1, $userId, PDO::PARAM_INT);
            $stmt->bindValue(2, $totalAmount, PDO::PARAM_STR);
            $stmt->execute();

            $orderId = $conn->lastInsertId();

            $cartQuery = "SELECT * FROM cart WHERE user_id = ?";
            $stmt = $conn->prepare($cartQuery);
            $stmt->bindValue(1, $userId, PDO::PARAM_INT);
            $stmt->execute();
            $cartResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($cartResult as $cart) {
                $orderDetailsQuery = "INSERT INTO order_details (order_id, product_id, quantity) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($orderDetailsQuery);
                $stmt->bindValue(1, $orderId, PDO::PARAM_INT);
                $stmt->bindValue(2, $cart['product_id'], PDO::PARAM_INT);
                $stmt->bindValue(3, $cart['quantity'], PDO::PARAM_INT);
                $stmt->execute();
            }

            $clearCartQuery = "DELETE FROM cart WHERE user_id = ?";
            $stmt = $conn->prepare($clearCartQuery);
            $stmt->bindValue(1, $userId, PDO::PARAM_INT);
            $stmt->execute();

            $updateCurrencyQuery = "UPDATE users SET credits = credits - ? WHERE id = ?";
            $stmt = $conn->prepare($updateCurrencyQuery);
            $stmt->bindValue(1, $totalAmount, PDO::PARAM_STR);
            $stmt->bindValue(2, $userId, PDO::PARAM_INT);
            $stmt->execute();

            echo "Bestelling succesvol geplaatst!";
        } else {
            echo "Onvoldoende saldo om de bestelling te plaatsen.";
        }
    }

    $statement = $conn->prepare("SELECT product_id, quantity, total_price FROM cart WHERE user_id = :user_id");
    $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

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

    foreach ($result as $row) {
        $totalQuantity += $row['quantity'];
        $totalPrice += $row['total_price'];
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
                echo "<td>" . htmlspecialchars($row['total_price']) . "</td>";
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
                echo "<td><strong>" . htmlspecialchars($totalPrice) . "</strong></td>";
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