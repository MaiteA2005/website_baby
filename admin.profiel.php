<?php

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel Pagina</title>
    <link rel="stylesheet" href="css/style.login.css">
    <link rel="stylesheet" href="css/style.nav.admin.css">
    <link rel="stylesheet" href="css/style.dashboard.css">
</head>
<body>
    <?php include_once("admin.nav.inc.php");?>    
    <h1>Profiel Pagina</h1>
    <form action="profiel.php" method="post">
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="" required><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="" required><br>

        <label for="password">Wachtwoord (leeg laten om niet te wijzigen):</label>
        <input type="password" id="password" name="password"><br>

        <button type="submit">Bijwerken</button>
        <br>
        <a href="logout.php" class="navbar__logout">Hi Stranger, logout?</a>
    </form>
</body>
</html>