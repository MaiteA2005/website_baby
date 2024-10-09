<?php
    //logica & data
    //$username = 'memes';

    $comments = [
        [
            "username"=> "memes",
            "avatar" => 'image-1.png',
            'comment' => "Hold my shoes!",
            "verified" => true
        ],
        [
            "username"=> "udus",
            "avatar" => 'image-2.png',
            'comment' => "yes asf!",
            "verified" => false
        ],
        [
            "username"=> "stevens31705",
            "avatar" => 'image-3.png',
            'comment' => "om my GOD",
            "verified" => true
        ],
    ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP intro</title>
</head>
<body>
    <ul>
        <?php foreach($comments as $comment): ?>
            <?php if($comment['verified'] === true): ?>    
                <li>
                    <img src="images/<?php echo $comment['avatar']; ?>" alt="User 1">
                    <strong><?php echo $comment['username']; ?></strong>
                    <p><?php echo $comment['comment']; ?></p>
                </li>
            <?php endif; ?>    
        <?php endforeach; ?>    
    </ul>
</body>
</html>


