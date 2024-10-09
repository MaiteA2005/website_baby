<?php
	function canLogin($p_email, $p_password){//p = parameter
		if($p_email === 'tigerKing.com' && $p_password === "12345"){
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
			//ok met cookie
			//$salt = "yt5789HJKJNBVFHKhygLMNO,ejngdhrfjed678";
			//$cookieValue = $email . "," . md5($email.$salt);
			//setcookie("login", $cookieValue, time()+60*60*24*30);

			//ok met sessies
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
  <title>IMDFlix</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="netflixLogin">
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
					<input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Remember me</label>
				</div>
			</form>
		</div>
	</div>
</body>
</html>