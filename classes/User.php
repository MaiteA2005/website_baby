<?php
    include_once('Db.php');

    class User{
        private $firstname;
        private $lastname;


        /Get the value of firstname
        
        public function getFirstname()
        {
                return $this->firstname;
        }

        /**Set the value of firstname
         *
         * @return  self
         */ 
        public function setFirstname($firstname)
        {
                $this->firstname = $firstname;

                return $this;
        }

        //Get the value of lastname
          
        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 
        public function setLastname($lastname)
        {
                $this->lastname = $lastname;

                return $this;
        }

        //SIGNUP
        $user = new User();
        $user->setFirstname($_POST['firstname']);
        //...
        $user->save();


        //LOGIN
        if(User::canLogin($_POST['email'], $_POST['password'])){
            //login
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
        $statement = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $statement->execute([
            'email' => $email,
            'password' => $password
        ]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user){
            return true;
        } else{
            return false;
        }
    }

    public static function isLoggedIn(){
        session_start();
        if($_SESSION['loggedin'] !== true){
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