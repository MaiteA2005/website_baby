<?php
	require_once(__DIR__ . "/classes/User.php");
	require_once(__DIR__ . "/classes/Db.php");

	use Website\XD\Classes\User;

	if (!empty($_POST)) {
		$user = new User();

		$user->setEmail($_POST['email']);
		$user->setPassword($_POST["password"]);

		//inloggen als admin of user
		if ($user->canLogin($_POST['email'], $_POST['password'])) {
			session_start();
			$_SESSION['loggedin'] = true;
			$_SESSION['email'] = $_POST['email'];
			
			//check if user is admin
			//if user is admin redirect to admin.index.php
			if ($user->isAdmin($_POST['email'])) {
				header('Location: admin.index.php');
			} else {
				header('Location: index.php');
			}
			exit();
		} else {
			$error = true;
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
				<h2 form__title>Log In</h2>
				<h2 form__title><a href="signup.php">Sign up</a></h2>

				<?php if(isset($error)): ?>
				<div class="form__error">
					<p>
						Sorry, we can't log you in with that email address and password. Can you try again?
					</p>
				</div>
				<?php endif; ?>

				<div class="form__field">
					<label for="Email">Email</label>
					<input type="text" name="email">
				</div>
				<div class="form__field">
					<label for="Password">Password</label>
					<input type="password" name="password">
				</div>

				<div class="form__field">
					<input type="submit" value="Log in" class="btn btn--primary">	
				</div>
                
			</form>
			
		</div>
	</div>
</body>
</html>