<?php
class Database{
    private static $conn = null;
    private static $hostname = 'localhost';
    private static $username = 'root';
    private static $password = 'twinkle11';
    private static $database = 'library';
    
    private function __construct(){}

    public static function getConnection(){
        if(self::$conn == null){
            self::$conn = new mysqli(self::$hostname, self::$username, self::$password, self::$database);
        }
        return self::$conn;
    }
}
