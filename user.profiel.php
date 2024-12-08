<?php
    include_once(__DIR__ . "/bootstrap.php");
    require_once(__DIR__ . "/classes/Db.php");
    require_once(__DIR__ . "/classes/Cart.php");
    require_once(__DIR__ . "/classes/User.php");

    $conn = \Website\XD\Classes\Db::getConnection();
    $id = \Website\XD\Classes\User::isLoggedIn();
    
?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel</title>
    <link rel="stylesheet" href="css/style.index.css">
    <link rel="stylesheet" href="css/style.producten.css">
    <link rel="stylesheet" href="css/style.profiel.css">
</head>
<body>
    <?php include_once("nav.inc.php");?>
    <h1>Profiel</h1>
    <div class="sidebar">
        <ul class="sidebar__menu">
            <?php $page = isset($_GET['page']) ? $_GET['page'] : 'mijn_gegevens'; ?>
            <li><a href="user.profiel.php?page=mijn_gegevens">Mijn gegevens</a></li>
            <li><a href="user.profiel.php?page=bestellingen">Bestellingen</a></li>
            <li><a href="user.profiel.php?page=digital_currency">Digital currency</a></li>
            <li><a href="logout.php">Uitloggen</a></li>
        </ul>
    </div>

    <div class="content">
        <?php
        // Laad dynamisch inhoud op basis van de waarde van `page`
        switch ($page) {
            case 'mijn_gegevens':
                include_once("user.profiel.mijn_gegevens.php");
                break;
            case 'bestellingen':
                include_once("user.profiel.bestellingen.php");
                break;
            case 'digital_currency':
                include_once("user.profiel.digital_currency.php");
                break;
            default:
                include_once("user.profiel.mijn_gegevens.php");
                break;
        }
        ?>
    </div>
</body>
</html>
