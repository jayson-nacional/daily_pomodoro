<?php

use Dotenv\Dotenv;

include dirname(__DIR__, 2) . "/vendor/autoload.php";

function base64URLEncode(string $text): string
{
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($text));
}

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

if (isset($_COOKIE["TestJwt"])) {
    $jwt = $_COOKIE["TestJwt"];
    $exploded = explode(".", $jwt);

    if ($exploded) {
        $header = $exploded[0];
        $payload = $exploded[1];
        $jwtSignature = $exploded[2];
        $validatorSignature = hash_hmac("sha256", "{$header}.{$payload}", $_ENV["SECRET"], true);

        if (hash_equals($jwtSignature, base64URLEncode($validatorSignature))) {
            ; // valid jwt
        } else {
            header("Location: /dailypomodoro/login.php");
            exit();
        }
    }
} else {
    header("Location: /dailypomodoro/login.php");
    exit();
}
