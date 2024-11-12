<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webshop";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
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
    <nav>
        <ul>
            <li><a href="index.php" class='nav_text'>Home</a></li>
            <li>
                <div class="dropdown">
                    <a href="" class='nav_text'> Categoriën </a>
                    <ul class="dropdown-menu">
                        <li><a href="kleren.php" class="dropdown-item">Kleren</a></li>
                        <li><a href="speelgoed.php" class="dropdown-item" >Speelgoed</a></li>
                        <li><a href="eten&drinken.php" class="dropdown-item" >Eten en drinken</a></li>
                        <li><a href="slaaphulpjes.php" class="dropdown-item" >Slaaphulpjes</a></li>
                    </ul>
                </div>
            </li>
            <div class="icons"></div>
            <li><a href="zoeken.php"><img src="./images/zoeken.png" alt="Zoeken" ></a></li>
            <li><a href=""><img src="./images/digital_currency.png" alt="Digital currency"></a></li>
            <li><a href=""><img src="./images/heart_not_clicked.png" alt="Favorieten"></a></li>
            <li><a href=""><img src="./images/shopping-cart.png" alt="Winkelmand"></a></li>
            <li><a href="profiel.php"><img src="./images/user.png" alt="Profiel"></a></li>
            </div>
        </ul>
    </nav>
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