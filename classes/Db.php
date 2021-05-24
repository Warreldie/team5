<?php
    abstract class Db {
        private static $conn;

    

        public static function getInstance(){
            
             $db_name = "imdtok";
             $db_user = "root";
             $db_password = "";
             $db_host = "localhost";
            
            if(self::$conn != null){
                // connection found, return connection
                return self::$conn;
            } else{
                
                self::$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
                return self::$conn;
            }
            
        }
    }