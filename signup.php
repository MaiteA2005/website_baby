<?php

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>
    </form>
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
					<input type="text" name="Street name">
				</div>
				<div class="form__field">
					<label for="house_number">House number</label>
					<input type="text" name="House number">
				</div>
                <div class="form__field">
					<label for="postal_code">Postal code</label>
					<input type="text" name="Postal code">
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