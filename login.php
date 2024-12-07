<?php
	require_once(__DIR__ . "/classes/User.php");
	require_once(__DIR__ . "/classes/Db.php");

	use Website\XD\Classes\User;

	if (!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])) {
		$user = new User();

		$email = $_POST['email'];
		$password = $_POST['password'];
	}
		
		else {
			$user->setEmail($email);
			$user->setPassword($password);

			// Log in as admin or user
			if ($user->canLogin($email, $password)) {
				session_start();
				$_SESSION['loggedin'] = true;
				$_SESSION['email'] = $email;
				
				// Check if user is admin
				if ($user->isAdmin($email)) {
					header('Location: admin.index.php');
				} else {
					header('Location: index.php');
				}
				exit();
			} else {
				$error = "Sorry, we can't log you in with that email address and password. Can you try again?";
			}
	} 
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Webshop</title>
  <link rel="stylesheet" href="css/style.login.css">
</head>
<body>
	<div class="websiteLogin">
		<div class="form form--login">
			<form action="" method="post">
				<div class="form__titles">
					<h2 class="form__title"><a class="active" href="login.php">Log in</a></h2>
					<h2 class="form__title"><a href="signup.php">Sign up</a></h2>
				</div>

				<?php if(isset($error)): ?>
				<div class="form__error">
					<p>
						<?php echo $error; ?>
					</p>
				</div>
				<?php endif; ?>

				<div class="form__field">
					<label for="email">Email</label>
					<input type="text" id="email" name="email" autocomplete="email" required>
				</div>
				<div class="form__field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" autocomplete="current-password" required>
				</div>

				<div class="form__field">
					<input type="submit" value="Log in" class="btn btn--primary">	
				</div>
				
			</form>
			
		</div>
	</div>
</body>
</html>