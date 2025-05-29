<?php

include __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_ENV["ENVIRONMENT"] == "Development") {
    error_reporting(E_ALL);
    ini_set("display_errors", "1");
}

header("Location: /dailypomodoro/src/todos/todos.php");
exit();
