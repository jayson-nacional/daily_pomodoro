<?php

use JaysonNacional\DailyPomodoro\classes\Database;

// Auth
include dirname(__DIR__, 1) . "/includes/auth.php";
// End of Auth flow

if (isset($_POST["submit"])) {
    if (isset($_POST["task"]) && !empty($_POST["task"])) {
        $pdo = Database::connect();
        $statement = $pdo->prepare("INSERT INTO todos(name, date, sequence_number)
								   VALUES(?, current_timestamp, 1)");
        if ($statement->execute([$_POST["task"]])) {
            header("Location: /dailypomodoro/src/todos/todos.php");
            exit();
        } else {
            echo "<script>alert('Error saving task.');</script>";
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
				<input name="task" type="text" class="form-control">
			</div>
			<div class="col-auto">
				<input type="submit" name="submit" value="Add" class="btn btn-primary mb-3">
				<a href="todos.php" class="btn btn-secondary mb-3">Cancel</a>
			</div>
		</form>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
			crossorigin="anonymous"></script>
	</body>
</html>
