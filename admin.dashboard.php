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
<nav>
    <ul>
      <li><a href="admin.index.php" class='nav_text'>Home</a></li>
      <li>
      <div class="dropdown">
      <a href="" class='nav_text'> Producten </a>
      <ul class="dropdown-menu">
        <li><a href="" class="dropdown-item">Toevoegen</a></li>
        <li><a href="" class="dropdown-item" >Verwijderen</a></li>
      </ul>
    </div></li>
    <div class="icons"></div>
        <li><a href="admin.dashboard.php"><img class="icon" src="./images/add.png" alt="Toevoegen" ></a></li>
        <li><a href=""><img class="icon" src="./images/bewerken.png" alt="Bewerken"></a></li>
        <li><a href=""><img class="icon" src="./images/delete.png" alt="Verwijder"></a></li>
        <li><a href="profiel.php"><img class="icon" src="./images/user.png" alt="Profiel"></a></li>
    </div>
    </ul>
  </nav>

  <div class='container'>
    <h2>Artikel toevoegen</h2>
    <form action="" method="post">
        <div class="form__field">
            <label class="form__field" for="title">Titel:</label>
            <input type="text" id="title" name="title" required><br>
        </div>
            
        <div class="form__field">
            <label for="description">Beschrijving:</label>
            <input type="text" id="description" name="description" class='description' required><br>
        </div>
            
        <div class="form__field">
            <label class="form__field" for="price">Prijs:</label>
            <input type="number" id="price" name="price" step="0.01" required><br>
        </div>
            
        <div class="form__field">
            <label class="form__field" for="category">Categorie:</label>
            <select type="category" name="category" required>
                <option value="Speelgoed">Speelgoed</option>
                <option value="Kleren">Kleren</option>
                <option value="Eten & drinken">Eten & drinken</option>
                <option value="Slaaphulpjes">Slaaphulpjes</option>
            </select><br>
        </div>

        <div class="form__field">
            <label class="form__field" for="color">Kleur:</label>
            <input type="text" id="color" name="color"><br>
        </div>

        <div class="form__field">
            <label class="form__field" for="image">Afbeelding:</label>
            <input type="file" id="image" name="image" accept="image/*"><br>
        </div>

        <div class="form__field">
            <input type="submit" value="Toevoegen" class="btn btn--primary">
        </div>
        </form>
  </div>

</body>
</html>