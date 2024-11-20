<?php
    /*namespace Website\XD\Classes;

    use PDO;

    class Db{
        
        //connectie maken met de databank
        private static $conn = null;

        public static function getConnection(){
            //Db :: getConnection();
            if(self::$conn == null){
                self::$conn = new PDO('mysql:host=localhost;dbname=webshop', 'root', '');
                return self::$conn;
            }
            else{
                return self::$conn;
            }
        }
    }*/

    class Db {

        private static $conn = null;
    
        public static function getInstance() {
    
            if (!self::$conn) {
                self::$conn = new PDO("mysql:host=localhost;dbname=webshop", "root", "");
                return self::$conn;
            }
    
            return self::$conn;
        }
    }
?>





