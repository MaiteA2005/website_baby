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

    // Fetch id from the database
    $query = $conn->prepare("SELECT id, credits FROM users WHERE email = ?");
    $query->bindValue(1, $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        $user = $result[0];
        $userId = $user['id'];
        $digitalCredits = $user['credits'];
    } else {
        echo "User not found.";
        exit;
    }

?>


<h2>Mijn digital currency</h2>

<h3>Saldo</h3>
</br>
<p>Uw saldo is: €<?php echo htmlspecialchars($digitalCredits); ?></p>