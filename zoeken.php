<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

$sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Products</title>
</head>
<body>
    <h1>Search Products</h1>
    <form method="post" action="">
        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
    </form>

    <?php
    if ($result && $result->num_rows > 0) {
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>" . htmlspecialchars($row['name']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No results found.";
    }
    ?>

    <?php $conn->close(); ?>
</body>
</html>