<?php
	function canLogin($p_email, $p_password){
		if($p_email === 'maite@shop.com' && $p_password === "12345isnotsecure"){
			return true;
		}else{
			return false;
		}
	}

	//wanneer inloggen
	if(!empty($_POST)){
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (canLogin($email, $password)){
			//oke
			session_start();
			$_SESSION['loggedin'] = true;
			$_SESSION['email'] = $email;

			header ("location: index.php");
		} else{
			//niet oke
			$error = true;
		}
		
	}
	

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Webshop</title>
  <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body>
	<div class="websiteLogin">
		<div class="form form--login">
			<form action="" method="post">
				<h2 form__title>Sign In</h2>

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
					<input type="submit" value="Sign in" class="btn btn--primary">	
				</div>
                
			</form>
		</div>
	</div>
</body>
</html>