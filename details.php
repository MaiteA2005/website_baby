<?php
    include_once(__DIR__ ."/bootstrap.php");
    require_once(__DIR__ ."/classes/Db.php");
    require_once(__DIR__ ."/classes/Review.php");
    
    $conn = \Website\XD\Classes\Db::getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // Check if user is logged in
     if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
        header('Location: login.php');
        exit;
    }
    
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

    //haal de categorie op van het product
    $categorieId = $product["categorie_id"];
    $categorieStmt = $conn->prepare("SELECT name FROM categories WHERE id = :id");
    $categorieStmt->execute(['id' => $categorieId]);
    $categorie = $categorieStmt->fetch();
  
    $email = $_SESSION['email'];

    // Fetch id from the database
    $query = $conn->prepare("SELECT id, firstname FROM users WHERE email = ?");
    $query->bindValue(1, $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
  
    if (count($result) > 0) {
        $user = $result[0];
        $userId = $user['id'];
        $firstname = $user['firstname'];
    } else {
        echo "User not found.";
        exit;
    }

    //haal alle reviews uit de databank die al bestaan
    $reviews = (new \Website\XD\Classes\Review())->getReviews($id);
    
    //voeg een nieuwe review toe
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $review = new \Website\XD\Classes\Review();
        $review->setProduct($id);
        $review->setRating($_POST['rating']);
        $review->setComment($_POST['review']);
        $review->setUserId($_POST['user_id']);
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
            echo '<div class="tekstDetail">';
                echo '<p> Prijs: €' . $product["price"] . '</p>';
                echo '<p> Kleur: ' . $product["color"] . '</p>';
                echo '<p> Categorie: ' . $categorie["name"] . '</p>';
                if (!empty($product["description"])) {
                    echo '<p> Beschrijving: ' . $product["description"] . '</p>';
                }
            echo '</br><button>Add to cart</button>';
            echo '<button onclick="history.back()">Go Back</button>';
            echo '</div>';
            echo '</div>';
        ?>
    </div>
    <div class="reviews">
        <h2>Reviews</h2>
        <div class="reviewContent">
            <form method="post">
                <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
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
                        echo '<div class="review">';
                        echo '<p>Name: ' . $firstname . '</p>';
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
    </div>
</body>
</html>