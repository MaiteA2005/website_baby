<?php
    include_once(__DIR__ . '/bootstrap.php');
    include_once(__DIR__ . '/classes/Db.php');
    
    // create a new PDO connection using the Db class
    $conn = \Website\XD\Classes\Db::getConnection();
    $statement = $conn->prepare("SELECT * FROM products");
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product toevoegen</title>
    <link rel="stylesheet" href="css/style.nav.admin.css">
    <link rel="stylesheet" href="css/style.dashboard.css">
</head>
<body>
    <?php include_once("admin.nav.inc.php");?>

  <div class='container'>
    <h2>Artikel toevoegen</h2>
    <form action="" method="post">
        <div class="form__field">
            <label class="form__field" for="title"><h3>Titel:</h3></label>
            <input type="text" id="title" name="title" required><br>
        </div>
            
        <div class="form__field">
            <label for="description"><h3>Beschrijving:</h3></label>
            <input type="text" id="description" name="description" class='description'><br>
        </div>
            
        <div class="form__field">
            <label class="form__field" for="price"><h3>Prijs:</h3></label>
            <input type="number" id="price" name="price" step="0.01" required><br>
        </div>
            
        <div class="form__field">
            <label class="form__field" for="category"><h3>Categorie:</h3></label>
            <select id="category" name="category" required>
                <option value="Speelgoed">Speelgoed</option>
                <option value="Kleren">Kleren</option>
                <option value="Eten & drinken">Eten & drinken</option>
                <option value="Slaaphulpjes">Slaaphulpjes</option>
            </select>
        </div>

        <div class="form__field">
            <label class="form__field" for="color"><h3>Kleur:</h3></label>
            <input type="text" id="color" name="color"><br>
        </div>

        <div class="form__field">
            <label class="form__field" for="image"><h3>Afbeelding:</h3></label>
            <input type="file" id="image" name="image" accept="image/*"><br>
        </div>

        <div class="form__field">
            <input type="submit" value="Toevoegen" class="btn btn--primary">
        </div>
        </form>
  </div>

</body>
</html>