<?php

declare(strict_types=1);

namespace Core;

use PDO;

class Database
{
    private static ?PDO $pdo = null;
    public static function getConnection(string $host, string $dbname, string $user, string $password): PDO
    {
        if (self::$pdo === null) {
            $dsn = "mysql:host=$host;dbname=$dbname;port=3306;charset=utf8";
            self::$pdo = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$pdo;
    }

}
