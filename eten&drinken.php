<?php
    include_once(__DIR__ . '/bootstrap.php'); 
    require_once(__DIR__ . "/classes/Db.php");

    try {
        $conn = \Website\XD\Classes\Db::getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM products WHERE categorie_id = '3'");
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
    <title>Eten en drinken</title>
    <link rel="stylesheet" href="css/style.index.css">
    <link rel="stylesheet" href="css/style.producten.css">
</head>
<body>
    <?php include_once("nav.inc.php");?>
    <h1>Eten & drinken</h1>
    <div class="container">
        <?php include_once("product.inc.php");?>
    </div>

</body>
</html>