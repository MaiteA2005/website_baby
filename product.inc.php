<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
        require_once 'classes/Cart.php';

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
        $productId = $_POST['product_id'];
        $quantity = 1; 

        $statement = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $statement->bindParam(':id', $productId, PDO::PARAM_INT);
        $statement->execute();
        $product = $statement->fetch(PDO::FETCH_ASSOC);

        //
        if ($product) {
            $total = $product["price"];
            $cart = new \Website\XD\Classes\Cart();
            $cart->addToCart($userId, $productId, $quantity, $total);

            header("Location: winkelmand.php");
            exit();
        } else {
            echo "Product not found.";
        }
    }

    foreach($products as $title => $productGroup) {
        $firstProduct = $productGroup[0];
        echo '<div class="article">';
        echo '<img  id="image-' . $title . '" src="./' . $firstProduct["image"] . '" alt="' . $firstProduct["title"] . '">';
        echo '<h2>' . $firstProduct["title"] . '</h2>';
        echo '<p>Prijs: €' . $firstProduct["price"] . '</p></br>';
        if (count($productGroup) > 1) {
            echo '<label for="color-' . $title . '">Kies een kleur: </br> </label>';
            echo '<select class="selector" name="color" id="color-' . $title . '" onchange="updateImage(\'' . $title . '\', this.value)">';
            foreach ($productGroup as $product) {
                echo '<option value="' . $product["color"] . '">' . $product["color"] . '</option>';
            }
            echo '</select>';
        }
        echo '<form method="post" action="">';
        echo '<input type="hidden" name="product_id" value="' . $firstProduct['id'] . '">';
        echo '<button type="submit" name="add_to_cart">Add to cart</button>';
        echo '</form>';
        echo '<a id="details-link-' . $title . '" href="details.php?id=' . urlencode($firstProduct["id"]) . '"><button>View Details</button></a>';
        echo '</div>';
    }
?>

<script>
    function updateImage(title, color) {
        var images = {
            <?php
                foreach ($products as $title => $productGroup) {
                    echo '"' . $title . '": [';
                    foreach ($productGroup as $product) {
                        echo '{color: "' . $product["color"] . '", image: "' . $product["image"] . '", id: "' . $product["id"] . '"},';
                    }
                    echo '],';
                }
            ?>
        };
        var productGroup = images[title];
        for (var i = 0; i < productGroup.length; i++) {
            if (productGroup[i].color === color) {
                document.getElementById('image-' + title).src = './' + productGroup[i].image;
                document.getElementById('details-link-' + title).href = 'details.php?id=' + productGroup[i].id;
                document.querySelector('input[name="product_id"]').value = productGroup[i].id;
                break;
            }
        }
    }
</script>