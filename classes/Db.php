<?php

class Db{
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
}
?>