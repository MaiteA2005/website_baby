<?php
    include_once (__DIR__ . '/bootstrap.php'); // Adjust the path if necessary
    require_once(__DIR__ . '/classes/Db.php');

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
                    echo '</br><button>Add to cart</button>';
                    echo '<button>View Details</button>';
                    echo '</div>';
                }
            } else {
                echo "Geen producten gevonden.";
            }
        }
        ?>
    
</body>
</html>