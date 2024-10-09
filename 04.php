<?php
    if(empty($_GET)){
        $genre = "all";
    }
    elseif(isset($_GET['genre'])){
        $genre = $_GET['genre']; //<= URL ?genre=
    }

    $concerts = [

        [
            "artist" => "blink182",
            "genre" => "punk",
            "date" => "2024-09-26",
            "image" => 'https://www.billboard.com/wp-content/uploads/2022/11/blink-182-2001-billboard-1548.jpg',
            'description' => 'American rock band formed in 1992 in Poway, California.'
        ],
        [
            "artist" => "guns n roses",
            "genre" => "punk",
            "date" => "2024-09-28",
            "image" => 'https://cdn-radio.dpgmedia.net/a/1c/3c/12/1326516/guns-n-roses_0.jpg',
            'description' => 'American hard rock band from Los Angeles, California, formed in 1985.'
        ],
        [
            "artist" => "EMEI",
            "genre" => "pop",
            "date" => "2024-09-27",
            "image" => 'https://mundanemag.com/wp-content/uploads/2021/10/party9v2-1280x640.jpg',
            'description' => 'Emily Li, professionally known as Emei, is an alternative pop musician based in Los Angeles, California.'
        ],
        [
            "artist" => "Biosphere",
            "genre" => "electronic",
            "date" => "2024-09-29",
            "image" => 'https://assets.boomkat.com/spree/products/364771/large/5027803146624.jpg',
            'description' => 'Biosphere alias Geir Jenssen is een Noors musicus die een opmerkelijk oeuvre aan ambientmuziek heeft geproduceerd'
        ]
    ];

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/04.css">
    <title>AB concerts</title>
</head>
<body>
    <?php include_once("nav.inc.php");?>

    <main>
        <?php foreach($concerts as $concert): ?>
            <?php if($genre === $concert['genre'] || $genre === 'all'): ?>
            <article class="concert">
                <div class="concert__graphic" style= 'background-image: url(<?php echo $concert["image"] ?>)'>
                    <span class="concert__date" ><?php echo date("D d M y", strtotime($concert['date'])) ?></span>
                </div>
                <div class="concert__details">
                    <h2 class="concert__artist"><?php echo $concert["artist"] ?></h2>
                    <p class="concert__description"><?php echo $concert["description"] ?></p>
                </div>
            </article>
            <?php endif; ?>
        <?php endforeach; ?>
    </main>
</body>
</html>