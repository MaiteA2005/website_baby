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


?>

<h2>Mijn bestellingen</h2>

<?php
    // Fetch orders for the user
$orderQuery = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
$orderQuery->bindValue(1, $userId, PDO::PARAM_INT);
$orderQuery->execute();
$orders = $orderQuery->fetchAll(PDO::FETCH_ASSOC);


if (count($orders) > 0) {
    foreach ($orders as $order) {
        echo "<div class='article'>";
        echo "<h3>Order #" . htmlspecialchars($order['id']) . "</h3>";
        echo "</br><p>Order Date: " . htmlspecialchars($order['date']) . "</p>";
        echo "<p>Total Price: € " . htmlspecialchars($order['total_price']) . "</p>";
        echo "</br><button class='btn--sec' onclick='toggleProducts(" . htmlspecialchars($order['id']) . ")'>View Products</button>";
            echo "<div id='products-" . htmlspecialchars($order['id']) . "' style='display:none;'>";
            
            // Fetch products for the order
            $productQuery = $conn->prepare("SELECT * FROM order_details WHERE order_id = ?");
            $productQuery->bindValue(1, $order['id'], PDO::PARAM_INT);
            $productQuery->execute();
            $products = $productQuery->fetchAll(PDO::FETCH_ASSOC);

            if (count($products) > 0) {
                echo "<div class='lijstProd'>";
                foreach ($products as $product) {
                    $titleQuery = $conn->prepare("SELECT title FROM products WHERE id = ?");
                    $titleQuery->bindValue(1, $product['product_id'], PDO::PARAM_INT);
                    $titleQuery->execute();
                    $titleResult = $titleQuery->fetch(PDO::FETCH_ASSOC);
                    $title = $titleResult['title'];
                    
                    echo  $title . "</br>";
                    echo "Quantity: " . htmlspecialchars($product['quantity']) . "</br></br>";
                }
                echo "</div>";
            } else {
                echo "<p>No products found for this order.</p>";
            }

            echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No orders found.</p>";
}


?>


<script>
    function toggleProducts(orderId) {
        var productsView = document.getElementById('products-' + orderId);
        if (productsView.style.display === 'none') {
            productsView.style.display = 'block';
        } else {
            productsView.style.display = 'none';
        }
    }
</script>