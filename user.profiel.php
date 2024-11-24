<?php

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel Pagina</title>
    <link rel="stylesheet" href="css/style.index.css">
    <link rel="stylesheet" href="css/style.producten.css">
    <link rel="stylesheet" href="css/style.profiel.css">
</head>
<body>
    <?php include_once("nav.inc.php");?>
    <h1>Profiel Pagina</h1>
    <div class="sidebar">
        <ul class="sidebar__menu">
            <li><a href="#">Mijn gegevens</a></li>
            <li><a href="#">Bestellingen</a></li>
            <li><a href="#">Digital currency</a></li>
            <li><a href="logout.php">Uitloggen</a></li>
        </ul>
    </div>
    <div class="form form--login">
			<form action="" method="post">
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
					<input type="submit" value="Bewerken" class="btn btn--primary">	
				</div>
                
			</form>
		</div>
	</div>
</body>
</html>