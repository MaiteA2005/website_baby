<?php
    include_once(__DIR__ . "/bootstrap.php");
    require_once(__DIR__ . "/classes/Db.php");
    require_once(__DIR__ . "/classes/User.php");

    $conn = \Website\XD\Classes\Db::getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if user is logged in
    if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
        header('Location: login.php');
        exit;
    }

    $email = $_SESSION['email'];

    // Fetch user data from the database
    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->bindValue(1, $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        $user = $result[0];
    } else {
        echo "User not found.";
        exit;
    }

    // Update user data if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $streetName = $_POST['street_name'];
        $houseNumber = $_POST['house_number'];
        $postalCode = $_POST['postal_code'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        // Hash the password if it is not empty
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            // Keep the old password if the new password is empty
            $password = $user['password'];
        }

        $updateQuery = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, password = ?, street_name = ?, house_number = ?, postal_code = ?, city = ?, country = ? WHERE email = ?");
        $updateQuery->execute([$firstName, $lastName, $email, $password, $streetName, $houseNumber, $postalCode, $city, $country, $_SESSION['email']]);

        // Update session email if changed
        $_SESSION['email'] = $email;

        echo "Gegevens succesvol bijgewerkt.";
    }
?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel Pagina</title>
    <link rel="stylesheet" href="css/style.login.css">
    <link rel="stylesheet" href="css/style.admin.profiel.css">
    <link rel="stylesheet" href="css/style.admin.css">
</head>
<body>
    <?php include_once("admin.nav.inc.php");?>

    <h1>Mijn gegevens</h1>

    <div class="form form--profiel">
        <form action="" method="post">
            <div class="form__field">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
            </div>
            
            <div class="form__field">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['lastname']); ?>">
            </div>

            <div class="form__field">
                <label for="email">Email</label>
                <input type="text" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
            </div>

            <div class="form__field">
                <label for="password">Password</label>
                <input type="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" placeholder="Enter new password">
            </div>
            
            <div class="form__field">
                <label for="street_name">Street name</label>
                <input type="text" name="street_name" value="<?php echo htmlspecialchars($user['street_name']); ?>">
            </div>

            <div class="form__field">
                <label for="house_number">House number</label>
                <input type="text" name="house_number" value="<?php echo htmlspecialchars($user['house_number']); ?>">
            </div>

            <div class="form__field">
                <label for="postal_code">Postal code</label>
                <input type="text" name="postal_code" value="<?php echo htmlspecialchars($user['postal_code']); ?>">
            </div>

            <div class="form__field">
                <label for="city">City</label>
                <input type="text" name="city" value="<?php echo htmlspecialchars($user['city']); ?>">
            </div>

            <div class="form__field">
                <label for="country">Country</label>
                <input type="text" name="country" value="<?php echo htmlspecialchars($user['country']); ?>">
            </div>

            <div class="form__field">
                <input type="submit" value="Bewerken" class="btn btn--primary">    
            </div>
            
        </form>
    </div>
</body>
</html>

