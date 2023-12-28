<?php

namespace Mehdi\Core\DB;

use Mehdi\Core\Helpers\Config;
use PDO;

class DB
{
    private static ?PDO $conn = null;

    public static function getConn(): PDO
    {
        if (! is_null(static::$conn)) {
            return static::$conn;
        }
        return static::new();
    }
    private static function new(): PDO
    {
        static::$conn = new PDO(
            'mysql:host='.Config::get('database.db_host').';dbname='.Config::get('database.db_name'),
            Config::get('database.db_username'),
            Config::get('database.db_password')
        );

        return static::$conn;
     }
}