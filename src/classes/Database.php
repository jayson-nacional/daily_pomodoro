<?php

namespace JaysonNacional\DailyPomodoro\classes;

use Dotenv\Dotenv;
use Exception;
use PDO;

include dirname(__DIR__, 2) . "/vendor/autoload.php";

class Database
{
    public static function connect(): ?PDO
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();

        $dsn = $_ENV["DSN"];
        $userName = $_ENV["USER_NAME"];
        $passWord = $_ENV["PASSWORD"];

        try {
            return new PDO(dsn: $dsn, username: $userName, password: $passWord);
        } catch (Exception $e) {
            return null;
        }
    }
}
