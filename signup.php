<?php
    if(!empty($_POST)){
        $first_name = $_POST['first_name']; 
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $options = [
            'cost' => 12,
        ];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT,$options);
        $street_name = $_POST['street_name'];
        $house_number = $_POST['house_number'];
        $postal_code = $_POST['postal_code'];
        $city = $_POST['city'];
        $country = $_POST['country'];
    
        $conn = new PDO('mysql:host=localhost;dbname=webshop', "root","");
        $query = $conn->prepare("insert into user (firstname, lastname, email, password, street_name, house_number, postal_code, city, country ) 
        values (:firstname, :lastname, :email, :password, :streetname, :housenumber, :postalcode, :city, :country)");

        $query->bindValue(':firstname', $first_name);
        $query->bindValue(':lastname', $last_name);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $query->bindValue(':streetname', $street_name);
        $query->bindValue(':housenumber', $house_number);
        $query->bindValue(':postalcode', $postal_code);
        $query->bindValue(':city', $city);
        $query->bindValue(':country', $country);

        $query->execute();
        header("location: login.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./css/stylesheet.css">
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