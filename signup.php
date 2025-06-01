<?php

use JaysonNacional\DailyPomodoro\classes\Database;

include dirname(__DIR__) . "/daily_pomodoro/vendor/autoload.php";

$errorMessages = array();
if (isset($_POST["submit"])) {
    if (isset($_POST["username"])) {
        if (empty($_POST["username"])) {
            $errorMessages[] = "Username is required.";
        } else {
            if (strlen($_POST["username"]) > 30) {
                $errorMessages[] = "Username cannot be longer than 30 characters.";
                var_dump($errorMessages);
            } else {
                $pdo = Database::connect();

                $statement = $pdo->prepare("SELECT * FROM accounts WHERE username = ?;");
                $statement->execute([$_POST["username"]]);

                $rows = $statement->fetch(PDO::FETCH_ASSOC);
                if ($rows) {
                    $errorMessages[] = "Username has already been taken.";
                } else {
                    if (isset($_POST["password1"])) {
                        if (empty($_POST["password1"])) {
                            $errorMessages[] = "Password is required.";
                        } elseif ($_POST["password1"] != $_POST["password2"]) {
                            $errorMessages[] = "Password mismatch.";
                        } else {
							$hashedPassword = password_hash($_POST["password1"], PASSWORD_BCRYPT);

                            $statement = $pdo->prepare("INSERT INTO accounts(username, password) VALUES(?, ?);");
                            $statement->execute([$_POST["username"], $hashedPassword]);

                            $statement->fetch(PDO::FETCH_ASSOC);
                        }
                    }
                }
            }
        }
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
		<form  method="POST">
			<div class="mb-3">
				<label for="username" class="form-label">Username</label>
				<input type="text" class="form-control" id="username" name="username">
			</div>
			<div class="mb-3">
				<label for="password1" class="form-label">Password</label>
				<input type="password" class="form-control" id="password1" name="password1">
			</div>
			<div class="mb-3">
				<label for="password2" class="form-label">Re-type Password</label>
				<input type="password" class="form-control" id="password2" name="password2">
			</div>

			<a href="login.php" class="btn btn-secondary">Cancel</a>
			<input type="submit" name="submit" class="btn btn-primary" value="Register">
		</form>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
			crossorigin="anonymous"></script>
	</body>
</html>
