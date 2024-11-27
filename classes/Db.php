<?php
    namespace Website\XD\Classes;

    use PDO;

    class Db{
        
        //connectie maken met de databank
        private static $conn = null;

        public static function getConnection(){
            //Db :: getConnection();
            if(self::$conn == null){
                try{
                    $host = "junction.proxy.rlwy.net";
                    $dbname = "webshop";
                    $user = "root";
                    $pass = "OjNOfIRAMXFBTyIgNhbvmwPhrehxAyqH";
                    $port = "19872";

                    self::$conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $user, $pass);
                    self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return self::$conn;
                } catch(PDOException $e){
                    echo "Connection failed: " . $e->getMessage();
                    return null;
                }
            }else{
            return self::$conn;}
    }}
?>
