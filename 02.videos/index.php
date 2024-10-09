<?php

    include_once("data.php")


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php basics</title>
</head>
<body>
    <main>
        <?php foreach ($videos as $key => $v): ?>
        <article>
            <a href="video.php?v=<?php echo $key; ?>">
                <img src="<?php echo $v['thumbnail']; ?>" alt="thumbnail">
                <h3><?php echo $v['description']; ?></h3>
            </a>
            
        </article>
        
        
        <?php endforeach; ?>
    </main>
      
</body>
</html>