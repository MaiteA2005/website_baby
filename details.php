<?php
<<<<<<< HEAD
    include_once(__DIR__ ."/bootstrap.php");
    
    $pdo = new PDO('mysql:dbname=webshop;host=localhost', "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $title = $_GET['title'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE title = :title");
    $stmt->execute(['title' => $title]);
    $product = $stmt->fetch();

    $categorieId = $product["categorie_id"];
    $categorieStmt = $pdo->prepare("SELECT name FROM categories WHERE id = :id");
    $categorieStmt->execute(['id' => $categorieId]);
    $categorie = $categorieStmt->fetch();
=======
    include_once("bootstrap.php");
>>>>>>> 2006ca7 (update 3 13/11)

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.login.css">
    <link rel="stylesheet" href="css/style.index.css">
    <link rel="stylesheet" href="css/style.producten.css">
<<<<<<< HEAD
    <link rel="stylesheet" href="css/style.details.css">
=======
>>>>>>> 2006ca7 (update 3 13/11)
</head>
<body>
    <?php include_once("nav.inc.php");?>
    <h1>Details</h1>
<<<<<<< HEAD
    <div class="container">
        <?php
            echo '<div class="detailArtikel">';
            echo '<img class="detailFoto" src="./' . $product["image"] . '" alt="' . $product["title"] . '">';
            echo '<h2>' . $product["title"] . '</h2>';
            echo '<p> Prijs: €' . $product["price"] . '</p>';
            echo '<p> Kleur: ' . $product["color"] . '</p>';
            echo '<p> Categorie: ' . $categorie["name"] . '</p>';
            echo '<p> Beschrijving: ' . $product["description"] . '</p>';
            echo '</br><button>Add to favorites</button>';
            echo '</br><button>Add to cart</button>';
            echo '</br><button>Go back</button>';
            echo '</div>';
        ?>
=======
>>>>>>> 2006ca7 (update 3 13/11)
</body>
</html>