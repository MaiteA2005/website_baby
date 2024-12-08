<?php
    include_once(__DIR__ . '/bootstrap.php');
    include_once(__DIR__ . '/classes/Db.php');
    
    // create a new PDO connection using the Db class
    $conn = \Website\XD\Classes\Db::getConnection();
    $statement = $conn->prepare("SELECT * FROM products");
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $category = $_POST['category'];
        $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
        
        // Mapping categories to category IDs
        $category_map = [
            'Speelgoed' => 1,
            'Kleren' => 2,
            'Eten & drinken' => 3,
            'Slaaphulpjes' => 4
        ];
        
        $categorie_id = $category_map[$category];

        // Upload image
        $target_dir = "images/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        // Prepend the image path with "/images/"
        $image_path = "./images/" . $image;

        // Insert product into database
        $stmt = $conn->prepare("INSERT INTO products (title, description, price, color, categorie_id, image) VALUES (:title, :description, :price, :color, :categorie_id, :image)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->bindParam(':image', $image_path);
        $stmt->execute();

        // Redirect to the same page to avoid form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product toevoegen</title>
    <link rel="stylesheet" href="css/style.admin.css">
    <link rel="stylesheet" href="css/style.dashboard.css">
</head>
<body>
    <?php include_once("admin.nav.inc.php");?>

  <div class='container'>
    <h2>Artikel toevoegen</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form__field">
            <label class="form__field" for="title">Titel:</label>
            <input type="text" id="title" name="title" required><br>
        </div>
            
        <div class="form__field">
            <label for="description">Beschrijving:</label>
            <input type="text" id="description" name="description" class='description'><br>
        </div>
            
        <div class="form__field">
            <label class="form__field" for="price">Prijs:</label>
            <input type="number" id="price" name="price" step="0.01" required><br>
        </div>

        <div class="form__field">
            <label class="form__field" for="color">Kleur:</label>
            <input type="text" id="color" name="color"><br>
        </div>
        
        <div class="form__field">
            <label class="form__field" for="category">Categorie:</label>
            <select id="category" name="category" required>
                <option value="Speelgoed">Speelgoed</option>
                <option value="Kleren">Kleren</option>
                <option value="Eten & drinken">Eten & drinken</option>
                <option value="Slaaphulpjes">Slaaphulpjes</option>
            </select>
        </div></br>

        <div class="form__field">
            <label class="form__field" for="image">Afbeelding:</label>
            <input type="file" id="image" name="image" accept="image/*"><br>
        </div>

        <div class="form__field">
            <a href="admin.index.php"><input type="submit" value="Toevoegen" class="btn btn--primary"></a>    
        </div>
    </form>
  </div>
</body>
</html>