<?php
    include_once(__DIR__ . '/bootstrap.php'); 

    try {
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT title, price, image, description, color FROM products WHERE categorie_id = '2'");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $products = [];
        foreach ($stmt->fetchAll() as $row) {
            $products[$row['title']][] = $row;
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kleren</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/style.index.css">
    <link rel="stylesheet" href="css/style.producten.css">
</head>
<body>
    <?php include_once("nav.inc.php");?>
    <h1>Kleren</h1>
    <div class="container">
        <?php
            foreach($products as $title => $productGroup) {
                $firstProduct = $productGroup[0];
                echo '<div class="article">';
                echo '<img  id="image-' . $title . '" src="./' . $firstProduct["image"] . '" alt="' . $firstProduct["title"] . '">';
                echo '<h2>' . $firstProduct["title"] . '</h2>';
                echo '<p>Price: €' . $firstProduct["price"] . '</p>';
                if (count($productGroup) > 1) {
                    echo '<label for="color-' . $title . '">Choose a color: </br> </label>';
                    echo '<select name="color" id="color-' . $title . '" onchange="updateImage(\'' . $title . '\', this.value)">';
                    foreach ($productGroup as $product) {
                        echo '<option value="' . $product["color"] . '">' . $product["color"] . '</option>';
                    }
                    echo '</select>';
                } 
            
                echo '</br><button>Add to favorites</button>';
                echo '</br><button>Add to cart</button>';
                echo '</br><button>View Details</button>';
                echo '</div>';
            }
        ?>
    </div>

    <script>
        function updateImage(title, color) {
            var images = <?php echo json_encode($products); ?>;
            var productGroup = images[title];
            for (var i = 0; i < productGroup.length; i++) {
                if (productGroup[i].color === color) {
                    document.getElementById('image-' + title).src = './' + productGroup[i].image;
                    break;
                }
            }
        }
    </script>
</body>
</html>