<?php

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <form action="process_signup.php" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="street_name">Street Name:</label>
        <input type="text" id="street_name" name="street_name" required><br>

        <label for="house_number">House Number:</label>
        <input type="text" id="house_number" name="house_number" required><br>

        <label for="postal_code">Postal Code:</label>
        <input type="text" id="postal_code" name="postal_code" required><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required><br>

        <label for="country">Country:</label>
        <input type="text" id="country" name="country" required><br>

        <input type="submit" value="Sign Up">
    </form>
</body>
</html>