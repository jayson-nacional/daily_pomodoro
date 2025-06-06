<?php

use Dotenv\Dotenv;
use JaysonNacional\DailyPomodoro\classes\Database;

include dirname(__DIR__, 2) . "/vendor/autoload.php";

function base64URLEncode(string $text): string
{
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($text));
}

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

if (isset($_COOKIE["TestJwt"])) {
    echo "Test cookie is set";

    $jwt = $_COOKIE["TestJwt"];
    $exploded = explode(".", $jwt);

    if ($exploded) {
        $header = $exploded[0];
        $payload = $exploded[1];
        $jwtSignature = $exploded[2];
        $validatorSignature = hash_hmac("sha256", "{$header}.{$payload}", $_ENV["SECRET"], true);

        if (hash_equals($jwtSignature, base64URLEncode($validatorSignature))) {
            echo "Has a valid signature";
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

if (isset($_GET["id"])) {
    $pdo = Database::connect();
    $statement = $pdo->prepare("SELECT * FROM todos WHERE id = ?");
    $statement->execute([$_GET["id"]]);

    $result = $statement->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: /dailypomodoro/src/todos/todos.php");
    exit();
}

if (isset($_POST["save"])) {
    if (isset($_POST["task"]) && !empty($_POST["task"])) {
        $pdo = Database::connect();
        $statement = $pdo->prepare("UPDATE todos SET name = ? WHERE id = ?");
        if ($statement->execute([$_POST["task"], $result["id"]])) {
            header("Location: /dailypomodoro/src/todos/todos.php");
            exit();
        } else {
            echo "<script>alert('Error updating task.');</script>";
        }
    } else {
        echo "<script>alert('Task cannot be empty.');</script>";
    }
}
?>

<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width" />
		<title>Daily Pomodoro</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" 
			rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" 
			crossorigin="anonymous">
	</head>
	<body>
		<form class="row g-2" method="POST">
			<div class="col-auto">
				<input name="task" type="text" class="form-control" value="<?= $result["name"] ?>">
			</div>
			<div class="col-auto">
				<input type="submit" name="save" value="Save" class="btn btn-primary mb-3">
				<a href="todos.php" class="btn btn-secondary mb-3">Cancel</a>
			</div>
		</form>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
			crossorigin="anonymous"></script>
	</body>
</html>
