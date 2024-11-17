<?php 
    namespace Website\XD\Classes;

    include_once(__DIR__ . "/Db.php");

    class User{
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $street_name;
        private $house_number;
        private $postal_code;
        private $city;
        private $country;


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

        public function save(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO users (firstname, lastname) VALUES (:firstname, :lastname)");
            $statement->execute([
                'firstname' => $this->getFirstname(),
                'lastname' => $this->getLastname()
            ]);
        }
        
        public static function canLogin($email, $password){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from user where email = :email");
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
            session_start();
            if($_SESSION['loggedin'] !== true){
                $_SESSION['email'] = $_POST['email'];
                header('Location: login.php');
            }
        }

        public static function logout(){
            session_start();
            session_destroy();
            header('Location: login.php');
        }
}
?>