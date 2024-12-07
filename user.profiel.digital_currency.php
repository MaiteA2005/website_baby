<?php
    include_once(__DIR__ . "/bootstrap.php");
    require_once(__DIR__ . "/classes/Db.php");
    require_once(__DIR__ . "/classes/User.php");

    $conn = \Website\XD\Classes\Db::getConnection();
    $id = \Website\XD\Classes\User::isLoggedIn();
    $user = new \Website\XD\Classes\User($id);
    $credits = $user->viewCredits($id);

?>


<h2>Mijn digital currency</h2>

<h3>Saldo</h3>
</br>
<p>Uw saldo is: €<?php echo htmlspecialchars($user->viewCredits($id)); ?></p>