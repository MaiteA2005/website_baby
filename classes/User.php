<?php 
    namespace Website\XD\Classes;
    include_once(__DIR__ . "/Db.php");
    use PDO;
    use Exception;
    

    class User{
        private $id;
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $typeOfUser;
        private $street_name;
        private $house_number;
        private $postal_code;
        private $city;
        private $country;
        private $credits;
        
        //Get the value of id
        public function getId(){
            return $this->id;
        }

        //Set the value of id
        public function setId($id){
            if(empty($id)){
                throw new Exception('ID is required');
            }
            $this->id = $id;

            return $this;
        }

        //Get the value of firstname
        public function getFirstname(){
            return $this->firstname;
        }

        //Set the value of firstname
        public function setFirstname($firstname){
            if(empty($firstname)){
                throw new Exception('Firstname is required');
            }
            $this->firstname = $firstname;

            return $this;
        }

        //Get the value of lastname
        public function getLastname(){
            return $this->lastname;
        }

        //Set the value of lastname
        public function setLastname($lastname){
            if(empty($lastname)){
                throw new Exception('Lastname is required');
            }
            $this->lastname = $lastname;

            return $this;
        }
    
        //Get the value of email
        public function getEmail(){
            return $this->email;
        }

        //Set the value of email
        public function setEmail($email){
            if(empty($email)){
                throw new Exception('Email is required');
            }
            $this->email = $email;

            return $this;
        }

        //Get the value of password 
        public function getPassword(){
            return $this->password;
        }

        //Set the value of password
        public function setPassword($password){
            if(empty($password)){
                throw new Exception('Password is required');
            }

            $this->password = $password;

            return $this;
        }

         //Get the value of typeOfUser
         public function getTypeOfUser()
         {
                 return $this->typeOfUser;
         }
 
         //Set the value of typeOfUser @return  self
         public function setTypeOfUser($typeOfUser)
         {
                 $this->typeOfUser = $typeOfUser;
 
                 return $this;
         }

        //Get the value of street_name 
        public function getStreet_name(){
            return $this->street_name;
        }

        //Set the value of street_name
        public function setStreet_name($street_name){
            if(empty($street_name)){
                throw new Exception('Street name is required');
            }

            $this->street_name = $street_name;

            return $this;
        }

        //Get the value of house_number
        public function getHouse_number(){
            return $this->house_number;
        }

        //Set the value of house_number
        public function setHouse_number($house_number){
            if(empty($house_number)){
                throw new Exception('House number is required');
            }
            
            $this->house_number = $house_number;

            return $this;
        }

        //Get the value of postal_code
        public function getPostal_code(){
            return $this->postal_code;
        }

        //Set the value of postal_code
        public function setPostal_code($postal_code){
            if(empty($postal_code)){
                throw new Exception('Postal code is required');
            }
            
            $this->postal_code = $postal_code;

            return $this;
        }

        //Get the value of city 
        public function getCity(){
            return $this->city;
        }

        //Set the value of city
        public function setCity($city){
            if(empty($city)){
                throw new Exception('City is required');
            }
            
            $this->city = $city;

            return $this;
        }

        //Get the value of country
        public function getCountry(){
            return $this->country;
        }

        //Set the value of country
        public function setCountry($country){
            if(empty($country)){
                throw new Exception('Country is required');
            }

            $this->country = $country;

            return $this;
        }

        /**
         * Get the value of credits
         */ 
        public function getCredits()
        {
                return $this->credits;
        }

        /**
         * Set the value of credits
         *
         * @return  self
         */ 
        public function setCredits($credits)
        {
                $this->credits = $credits;

                return $this;
        }

        public function save() {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, street_name, house_number, postal_code, city, country) VALUES (:firstname, :lastname, :email, :password, :street_name, :house_number, :postal_code, :city, :country)");
            return $statement->execute([
                'firstname' => $this->getFirstName(),
                'lastname' => $this->getLastName(),
                'email' => $this->getEmail(),
                'password' => $this->getPassword(),
                'street_name' => $this->getStreet_name(),
                'house_number' => $this->getHouse_number(),
                'postal_code' => $this->getPostal_code(),
                'city' => $this->getCity(),
                'country' => $this->getCountry()
            ]);
        }
        
        public static function canLogin($email, $password){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where email = :email");
            $statement->bindValue(':email', $email);
            $statement->execute();
            $user = $statement->fetch();
            if(!$user){
                return false;
            }

            $hash = $user['password'];
            if(password_verify($password, $hash)){
                return true;
            } else{
                return false;
            }
        }

        public static function isLoggedIn(){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
                header('Location: login.php');
                exit();
            }
        }

        //Check if user is admin
        // als typeOfUser = admin redirecten naar admin.index.php
        public static function isAdmin($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where email = :email");
            $statement->bindValue(':email', $email);
            $statement->execute();
            $user = $statement->fetch();
            if($user['typeOfUser'] == 'admin'){
                header('Location: admin.index.php');
                exit();
            } else{
                header('Location: index.php');
                exit(); 
            }
        }

        //user mag geen toegan hebben tot admin.index.php
        //als typeOfUser = user redirecten naar index.php
        public static function isUser($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where email = :email");
            $statement->bindValue(':email', $email);
            $statement->execute();
            $user = $statement->fetch();
            if($user['typeOfUser'] == 'user'){
                header('Location: index.php');
                exit();
            } else{
                header('Location: admin.index.php');
                exit(); 
            }
        }

        //maak een functie voor de sign up
        /*public static function signUp(){
            $first_name = $_POST['first_name']; 
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $options = [
                'cost' => 12,
            ];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
            $street_name = $_POST['street_name'];
            $house_number = $_POST['house_number'];
            $postal_code = $_POST['postal_code'];
            $city = $_POST['city'];
            $country = $_POST['country'];

            
            $conn = Db::getConnection();
            $query = $conn->prepare("insert into users (firstname, lastname, email, password, street_name, house_number, postal_code, city, country ) 
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
        }*/

        public static function signUp() {
            try {
                $first_name = $_POST['first_name']; 
                $last_name = $_POST['last_name'];
                $email = $_POST['email'];
                $options = [
                    'cost' => 12,
                ];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
                $street_name = $_POST['street_name'];
                $house_number = $_POST['house_number'];
                $postal_code = $_POST['postal_code'];
                $city = $_POST['city'];
                $country = $_POST['country'];
        
                $conn = Db::getConnection();
        
                // Check if the email already exists
                $checkEmailQuery = $conn->prepare("SELECT COUNT(*) AS count FROM users WHERE email = :email");
                $checkEmailQuery->bindValue(':email', $email);
                $checkEmailQuery->execute();
                $result = $checkEmailQuery->fetch(PDO::FETCH_ASSOC);
        
                if ($result['count'] > 0) {
                    throw new Exception("This email address is already registered. Please use another email.");
                }
        
                // Insert new user into the database
                $query = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, street_name, house_number, postal_code, city, country) 
                    VALUES (:firstname, :lastname, :email, :password, :streetname, :housenumber, :postalcode, :city, :country)");
        
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
            } catch (Exception $e) {
                // Handle errors (e.g., email already exists or database issues)
                echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
            }
        }

        //functie om credits te updaten  updateCredits
        public function updateCredits($id, $credits){
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE users SET credits = :credits WHERE id = :id");
            $statement->execute([
                'credits' => $credits,
                'id' => $id
            ]);
        }

        //function to add order
        public function addOrder($user_id, $total_price, $quantity)
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO `order` (user_id, total_price, quantity) VALUES (:user_id, :total_price, :quantity)");
            $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $statement->bindParam(':total_price', $total_price, PDO::PARAM_STR);
            $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $statement->execute();
            return $result;
        }

        //function om de producten die besteld worden opgeslagen worden in de order_items (order_id, product_id)
        public function addOrderItems($order_id, $product_id)
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO order_items (order_id, product_id) VALUES (:order_id, :product_id)");
            $statement->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $statement->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $statement->execute();
            return $result;
        }
    }    
?>
