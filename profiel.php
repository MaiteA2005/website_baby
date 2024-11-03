<?php

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel Pagina</title>
</head>
<body>
    <h1>Profiel Pagina</h1>
    <form action="profiel.php" method="post">
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

        <label for="password">Wachtwoord (leeg laten om niet te wijzigen):</label>
        <input type="password" id="password" name="password"><br>

        <button type="submit">Bijwerken</button>
        <a href="logout.php" class="navbar__logout">Hi Stranger, logout?</a>
    </form>
</body>
</html>