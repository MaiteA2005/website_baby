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
				<h2 form__title><a href="login.php">Log in</a></h2>
				<h2 form__title>Sign up</h2>

				<div class="form__field">
					<label for="first_name">First Name</label>
					<input type="text" name="first_name" required>
				</div>
                
				<div class="form__field">
					<label for="last_name">Last Name</label>
					<input type="text" name="last_name">
				</div>

                <div class="form__field">
					<label for="Email">Email</label>
					<input type="text" name="email">
				</div>

				<div class="form__field">
					<label for="Password">Password</label>
					<input type="password" name="password">
				</div>
                
                <div class="form__field">
					<label for="street_name">Street name</label>
					<input type="text" name="street_name">
                </div>

				<div class="form__field">
					<label for="house_number">House number</label>
					<input type="text" name="house_number">
                </div>

                <div class="form__field">
					<label for="postal_code">Postal code</label>
					<input type="text" name="postal_code">
                </div>

				<div class="form__field">
					<label for="city">City</label>
					<input type="text" name="city">
				</div>

                <div class="form__field">
					<label for="country">Country</label>
					<input type="text" name="country">
                </div>

				<div class="form__field">
					<input type="submit" value="Sign up" class="btn btn--primary">	
				</div>
                
			</form>
		</div>
	</div>
</body>
</html>