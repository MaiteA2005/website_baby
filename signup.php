<?php
    require_once(__DIR__ . "/classes/User.php");
    require_once(__DIR__ . "/classes/Db.php");

    use Website\XD\Classes\User;

    if (!empty($_POST)) {
        $user = new User();

        $user->setFirstname($_POST['first_name']);
        $user->setLastname($_POST['last_name']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setStreet_name($_POST['street_name']);
        $user->setHouse_number($_POST['house_number']);
        $user->setPostal_code($_POST['postal_code']);
        $user->setCity($_POST['city']);
        $user->setCountry($_POST['country']);

        $user->signUp();

        header("Location: login.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/style.login.css">
</head>
<body>
    <div class="websiteLogin">
		<div class="form form--login">
			<form action="" method="post">
			<div class="form__titles">
					<h2 class="form__title"><a href="login.php">Log in</a></h2>
					<h2 class="form__title"><a class="active" href="signup.php">Sign up</a></h2>
				</div>
				<div class="form__field">
					<label for="first_name">First Name</label>
					<input type="text" id="first_name" name="first_name" autocomplete="given-name" required>
				</div>
				
				<div class="form__field">
					<label for="last_name">Last Name</label>
					<input type="text" id="last_name" name="last_name" autocomplete="family-name" required>
				</div>

				<div class="form__field">
					<label for="email">Email</label>
					<input type="email" id="email" name="email" autocomplete="email" required>
				</div>

				<div class="form__field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" autocomplete="new-password" required>
				</div>
				
				<div class="form__field">
					<label for="street_name">Street name</label>
					<input type="text" id="street_name" name="street_name" autocomplete="address-line1">
				</div>

				<div class="form__field">
					<label for="house_number">House number</label>
					<input type="text" id="house_number" name="house_number" autocomplete="address-line2">
				</div>

				<div class="form__field">
					<label for="postal_code">Postal code</label>
					<input type="text" id="postal_code" name="postal_code" autocomplete="postal-code">
				</div>

				<div class="form__field">
					<label for="city">City</label>
					<input type="text" id="city" name="city" autocomplete="address-level2">
				</div>

				<div class="form__field">
					<label for="country">Country</label>
					<input type="text" id="country" name="country" autocomplete="country">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign up" class="btn btn--primary">	
				</div>
                
			</form>
		</div>
	</div>
</body>
</html>