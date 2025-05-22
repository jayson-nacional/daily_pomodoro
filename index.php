<?php

include __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;
use JaysonNacional\DailyPomodoro\classes\Todos;

echo "Welcome to the Daily Pomodoro App. Your partner for productivity!</br>";

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_ENV["ENVIRONMENT"] == "Development") {
    error_reporting(E_ALL);
    ini_set("display_errors", "1");
}

$dsn = $_ENV["DSN"];
$username = $_ENV["USER_NAME"];
$password = $_ENV["PASSWORD"];

try {
    $pdo = new PDO(dsn: $dsn, username: $username, password: $password);

    $todo = new Todos();
    $todo->create();
    $todo->update();
    $todo->delete();
} catch (Exception $e) {
    echo $e->getMessage(), "</br>";
}
