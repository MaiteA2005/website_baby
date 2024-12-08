<?php
    include_once(__DIR__ . '/bootstrap.php');
    include_once(__DIR__ . '/classes/Db.php');
    include_once(__DIR__ . '/classes/User.php');
    
    $conn = \Website\XD\Classes\Db::getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch product details
    $productId = $_GET['id'];
    $stmt = $conn->prepare("SELECT products.*, categories.name as categorie FROM products JOIN categories ON products.categorie_id = categories.id WHERE products.id = :id");
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submission to update product details
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $categorie_id = $_POST['category'];
        $image = $_FILES['image']['name'];

        // Update product details in the database
        $updateStmt = $conn->prepare("UPDATE products SET title = :title, description = :description, price = :price, color = :color, categorie_id = :categorie_id, image = :image WHERE id = :id");
        $updateStmt->bindParam(':title', $title);
        $updateStmt->bindParam(':description', $description);
        $updateStmt->bindParam(':price', $price);
        $updateStmt->bindParam(':color', $color);
        $updateStmt->bindParam(':categorie_id', $categorie_id);
        $updateStmt->bindParam(':image', $image);
        $updateStmt->bindParam(':id', $productId, PDO::PARAM_INT);
        $updateStmt->execute();

        // Redirect to a success page or display a success message
        header("Location: admin.index.php");
        exit();
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Bewerken</title>
    <link rel="stylesheet" href="css/style.admin.css">
    <link rel="stylesheet" href="css/style.dashboard.css">
</head>
<body>
    <?php include_once("admin.nav.inc.php");?>

    <div class='container'>
        <h2>Artikel bewerken</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form__field">
                <label class="form__field" for="title">Titel:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($product['title']); ?>" required><br>
            </div>
                
            <div class="form__field">
                <label for="description">Beschrijving:</label>
                <input type="text" id="description" name="description" class='description' value="<?php echo htmlspecialchars($product['description']); ?>"><br>
            </div>
                
            <div class="form__field">
                <label class="form__field" for="price">Prijs:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required><br>
            </div>
                
            <div class="form__field">
                <label class="form__field" for="color">Kleur:</label>
                <input type="text" id="color" name="color" value="<?php echo htmlspecialchars($product['color']); ?>"><br>
            </div>
            
            <div class="form__field">
                <label class="form__field" for="category">Categorie:</label>
                <select id="category" name="category" required>
                    <option value="Speelgoed" <?php if ($product['categorie'] == 'Speelgoed') echo 'selected'; ?>>Speelgoed</option>
                    <option value="Kleren" <?php if ($product['categorie'] == 'Kleren') echo 'selected'; ?>>Kleren</option>
                    <option value="Eten & drinken" <?php if ($product['categorie'] == 'Eten & drinken') echo 'selected'; ?>>Eten & drinken</option>
                    <option value="Slaaphulpjes" <?php if ($product['categorie'] == 'Slaaphulpjes') echo 'selected'; ?>>Slaaphulpjes</option>
                </select>
            </div></br>

            <div class="form__field">
                <label class="form__field" for="image">Afbeelding:</label>
                <input type="file" id="image" name="image" accept="image/*"><br>
            </div>

            <div class="form__field">
                <input type="submit" value="Bewerken" class="btn btn--primary">
            </div>
        </form>
    </div>
</body>
</html>