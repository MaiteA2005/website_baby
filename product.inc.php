<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
        require_once 'classes/Cart.php';
        require_once 'classes/Db.php'; 

        $productId = $_POST['product_id'];
        $quantity = 1; 

        $statement = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $statement->bindParam(':id', $productId, PDO::PARAM_INT);
        $statement->execute();
        $product = $statement->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $total = $product["price"];
            $cart = new \Website\XD\Classes\Cart();
            $cart->addToCart($productId, $quantity, $total);

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