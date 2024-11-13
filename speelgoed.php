<?php
    include_once(__DIR__ . '/bootstrap.php');   
<<<<<<< HEAD
    require_once(__DIR__ . "/classes/Db.php");

    try {
        // create a new PDO connection using the Db class
        $conn = Db::getInstance();
=======

    try {
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
>>>>>>> 2006ca7 (update 3 13/11)

        $stmt = $conn->prepare("SELECT * FROM products WHERE categorie_id = '1'");
        $stmt->execute();

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
    <title>Speelgoed</title>
    <link rel="stylesheet" href="css/style.login.css">
    <link rel="stylesheet" href="css/style.index.css">
    <link rel="stylesheet" href="css/style.producten.css">
</head>
<body>
    <?php include_once("nav.inc.php");?>
    <h1 class="title">Speelgoed</h1>

<<<<<<< HEAD
    <div class="container"> 
=======
    <div class="container">
        
>>>>>>> 2006ca7 (update 3 13/11)
        <?php
            foreach($products as $title => $productGroup) {
                $firstProduct = $productGroup[0];
                echo '<div class="article">';
                echo '<img  id="image-' . $title . '" src="./' . $firstProduct["image"] . '" alt="' . $firstProduct["title"] . '">';
                echo '<h2>' . $firstProduct["title"] . '</h2>';
                echo '<p>Prijs: €' . $firstProduct["price"] . '</p>';
                if (count($productGroup) > 1) {
<<<<<<< HEAD
                    echo '<label for="color-' . $title . '">Kies een kleur: </br> </label>';
=======
                    echo '<label for="color-' . $title . '">Choose a color: </br> </label>';
>>>>>>> 2006ca7 (update 3 13/11)
                    echo '<select class="selector" name="color" id="color-' . $title . '" onchange="updateImage(\'' . $title . '\', this.value)">';
                    foreach ($productGroup as $product) {
                        echo '<option value="' . $product["color"] . '">' . $product["color"] . '</option>';
                    }
                    echo '</select>';
                }
                echo '</br><button>Add to favorites</button>';
                echo '</br><button>Add to cart</button>';
                echo '</br><a href="details.php?title=' . urlencode($firstProduct["title"]) . '"><button>View Details</button></a>';
                echo '</div>';
            }
        ?>
    </div>
    <script>
        function updateImage(title, color) {
            var images = {
                <?php
                    foreach ($products as $title => $productGroup) {
                        echo '"' . $title . '": [';
                        foreach ($productGroup as $product) {
                            echo '{color: "' . $product["color"] . '", image: "' . $product["image"] . '"},';
                        }
                        echo '],';
                    }
                ?>
            };
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