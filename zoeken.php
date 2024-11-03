<?php

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/style.index.css">
    <title>Zoeken</title>
</head>
<body>
    <nav>
    <ul>
        <li><a href="index.php" class='nav_text'>Home</a></li>
        <li>
        <div class="dropdown">
        <a href="" class='nav_text'> Categoriën </a>
        <ul class="dropdown-menu">
        <li><a href="" class="dropdown-item">Kleren</a></li>
        <li><a href="" class="dropdown-item" >Speelgoed</a></li>
        <li><a href="" class="dropdown-item" >Eten en drinken</a></li>
        <li><a href="" class="dropdown-item" >Slaaphulpjes</a></li>
        </ul>
    </div></li>
    <div class="icons"></div>
        <li><a href="zoeken.php"><img src="./images/zoeken.png" alt="Zoeken" ></a></li>
        <li><a href=""><img src="./images/digital_currency.png" alt="Digital currency"></a></li>
        <li><a href=""><img src="./images/heart_not_clicked.png" alt="Favorieten"></a></li>
        <li><a href=""><img src="./images/shopping-cart.png" alt="Winkelmand"></a></li>
        <li><a href="profiel.php"><img src="./images/user.png" alt="Profiel"></a></li>
    </div>
    </ul>
    </nav>
    <h1>Zoeken</h1>
    <form method="post" action="">
        <input type="text" name="search" value="">
        <button type="submit">Zoek</button>
    </form>
</body>
</html>