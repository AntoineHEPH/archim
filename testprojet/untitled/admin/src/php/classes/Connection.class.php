<?php

class Connection
{
    private static $_db = null;

    public static function getInstance($dsn, $user, $password)
    {
        try {
            self::$_db = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            print "Connection error: " . $e->getMessage();
        }

        return self::$_db;
    }
}



/*class Connection
{
    private static $_db = null;

    public static function getInstance($dsn, $user, $password)
    {
        if (!self::$_db) {
            try {
                self::$_db = new PDO($dsn, $user, $password);
                print "connected";
            } catch (PDOException $e) {
                print "Connection error: " . $e->getMessage();
            }
        }
    }
}
*/