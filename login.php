<?php

use JaysonNacional\DailyPomodoro\classes\Database;

include dirname(__DIR__) . "/daily_pomodoro/vendor/autoload.php";

if (isset($_POST["login"])) {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (empty($username) || empty($password)) {
            $errorMessage = "Username and password is required";
        } else {
            $pdo = Database::connect();
            $statement = $pdo->prepare("SELECT * FROM accounts WHERE username = ?");
            $statement->execute([$username]);

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) { // user exists
                if (password_verify($password, $result["password"])) {
                    echo "Successfully logged in";
                } else {
					echo "Incorrect password";
                }
            } else {
                echo "User does not exist";
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
				<label for="password" class="form-label">Password</label>
				<input type="password" class="form-control" id="password" name="password">
			</div>

			<?php if (isset($errorMessage)): ?>
				<div class="alert alert-danger" role="alert">
					<?= $errorMessage ?>
				</div>
			<?php endif; ?>

			<input type="submit" name="login" class="btn btn-primary" value="Login">
		</form>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
			crossorigin="anonymous"></script>
	</body>
</html>
