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
    }    
?>