<?php

include __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;

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
    // $stmt = $pdo->prepare("SELECT * FROM sandbox_table");
    // $stmt->execute();

    // $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // $result = $pdo->query("SELECT * FROM sandbox_table");
    // foreach ($result as $key => $value) {
    //     var_dump($value);
    //     echo "</br>";
    // }
    //
    $stmt = $pdo->prepare("SELECT * FROM sandbox_table");
    $stmt->execute();

    foreach ($stmt as $row) {
        echo "Item: " . $row["item"] . "</br>";
        echo "Description: " . $row["description"] . "</br>";
        echo "</br>";
    }
} catch (Exception $e) {
    echo $e->getMessage(), "</br>";
}
