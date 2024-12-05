<?php
    include_once(__DIR__ ."/bootstrap.php");
    require_once(__DIR__ ."/classes/Db.php");
    require_once(__DIR__ ."/classes/Review.php");
    
    $conn = \Website\XD\Classes\Db::getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($id === null) {
        echo '<p>ID is not set. Please provide a product ID in the URL.</p>';
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch();

    if (!$product) {
        die('Product not found.');
    }

    $categorieId = $product["categorie_id"];
    $categorieStmt = $conn->prepare("SELECT name FROM categories WHERE id = :id");
    $categorieStmt->execute(['id' => $categorieId]);
    $categorie = $categorieStmt->fetch();

    //haal alle reviews uit de databank die al bestaan
    $reviews = (new \Website\XD\Classes\Review())->getReviews($id);
    
    //voeg een nieuwe review toe
    if ($_POST) {
        $review = new \Website\XD\Classes\Review();
        $review->setProduct($id);
        $review->setRating($_POST['rating']);
        $review->setComment($_POST['review']);
        $review->save();
        header("Location: details.php?id=" . $id);
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="css/style.index.css">
    <link rel="stylesheet" href="css/style.producten.css">
    <link rel="stylesheet" href="css/style.details.css">

</head>
<body>
    <?php include_once("nav.inc.php");?>
    <h1>Details</h1>

    <div class="container">
        <?php
            echo '<div class="detailArtikel">';
            echo '<img class="detailFoto" src="./' . $product["image"] . '" alt="' . $product["title"] . '">';
            echo '<h2>' . $product["title"] . '</h2>';
            echo '<p> Prijs: €' . $product["price"] . '</p>';
            echo '<p> Kleur: ' . $product["color"] . '</p>';
            echo '<p> Categorie: ' . $categorie["name"] . '</p>';
            if (!empty($product["description"])) {
                echo '<p> Beschrijving: ' . $product["description"] . '</p>';
            }
            echo '</br><button>Add to favorites</button>';
            echo '</br><button>Add to cart</button>';
            echo '</div>';
        ?>
    </div>
    <div class="reviews">
        <h2>Reviews</h2>
        <form method="post">
            <label for="review">Review:</label>
            <textarea name="review" required></textarea>
            <label type="text" for="rating">Rating:</label>
            <select name="rating" required>
                <option value="0">☆☆☆☆☆</option>
                <option value="1">⭐☆☆☆☆</option>
                <option value="2">⭐⭐☆☆☆</option>
                <option value="3">⭐⭐⭐☆☆</option>
                <option value="4">⭐⭐⭐⭐☆</option>
                <option value="5">⭐⭐⭐⭐⭐</option>
            </select>
            <button type="submit">Submit Review</button>
        </form>
        <?php
            if ($reviews) {
                foreach ($reviews as $review) {
                    $username = (new \Website\XD\Classes\Review())->getUsername($review['user_id']);
                    echo '<div class="review">';
                    if ($username) {
                        echo '<p>Name: ' . $username['firstname'] . '</p>';
                    } else {
                        echo '<p>Name: Unknown</p>';
                    }
                    echo '<p>Rating: ';
                    for ($i = 0; $i < 5; $i++) {
                        if ($i < $review['rating']) {
                            echo '⭐';
                        } else {
                            echo '☆';
                        }
                    }
                    echo '</p>';
                    echo '<p>Review: ' . $review['comment'] . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No reviews yet. Be the first to review this product!</p>';
            }
        ?>
        
    </div>
</body>
</html>