<?php
abstract class Db
{
    private static $conn;

    public static function getInstance()
    {
       /* $db_name = "warrel_netimdtok";
        $db_user = "warrel_netimdtok";
        $db_password = "php@team5";
        $db_host = "warrel.net.mysql";*/

        $db_name = "imdtok";
        $db_user = "root";
        $db_password = "root";
        $db_host = "localhost";

        if (self::$conn != null) {
            //Connection found, return connection
            return self::$conn;
        } else {
            self::$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            return self::$conn;
        }
    }
}
