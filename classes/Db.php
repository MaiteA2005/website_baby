<?php
    namespace Website\XD\Classes;

    use PDO;

    class Db{
        
        //connectie maken met de databank
        private static $conn = null;

        public static function getConnection(){
            //Db :: getConnection();
            if(self::$conn == null){
                
                self::$conn = new PDO('mysql:host=localhost;dbname=webshop', 'root', '');
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            }
            return self::$conn;
        }
    }
?>
