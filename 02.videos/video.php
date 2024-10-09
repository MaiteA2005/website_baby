<?php 
    include_once("data.php")

    //var_dump($_GET);
    $key = $_GET['v'];
    echo $key;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $videos[$key]['description']; ?></title>
</head>
<body>
<?php echo $videos[$key]['description']; ?>
</body>
</html>