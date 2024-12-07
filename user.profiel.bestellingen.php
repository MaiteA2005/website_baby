<?php
    include_once(__DIR__ . "/bootstrap.php");
    require_once(__DIR__ . "/classes/Db.php");
    require_once(__DIR__ . "/classes/Cart.php");
    require_once(__DIR__ . "/classes/User.php");

    $conn = \Website\XD\Classes\Db::getConnection();
    $id = \Website\XD\Classes\User::isLoggedIn();
    $user = new \Website\XD\Classes\User($id);
?>

<h2>Mijn bestellingen</h2>

<?php
    $orders = $user->viewOrders($id);
    if (count($orders) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>Product</th>";
        echo "<th>Prijs</th>";
        echo "<th>Aantal</th>";
        echo "<th>Totaal</th>";
        echo "<th>datum</th>";
        echo "</tr>";
        foreach ($orders as $order) {
            echo "<tr>";
            echo "<td>" . $order['product_name'] . "</td>";
            echo "<td>€" . $order['price'] . "</td>";
            echo "<td>" . $order['quantity'] . "</td>";
            echo "<td>€" . $order['total'] . "</td>";
            echo "<td>" . $order['datum'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>U heeft nog geen bestellingen geplaatst.</p>";
    }