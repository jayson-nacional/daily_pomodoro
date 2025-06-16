<?php

use JaysonNacional\DailyPomodoro\classes\Database;

// Auth
include dirname(__DIR__, 1) . "/includes/auth.php";
// End of Auth flow

if (isset($_GET["id"])) {
    $pdo = Database::connect();
    $statement = $pdo->prepare("SELECT * FROM todos WHERE id = ?");
    $statement->execute([$_GET["id"]]);

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if (isset($_GET["confirm"])) {
        $confirm = $_GET["confirm"];

        if ($confirm == 1) {
            $statement = $pdo->prepare("DELETE FROM todos WHERE id = ?");
            if ($statement->execute([$result["id"]])) {
                header("Location: /dailypomodoro/src/todos/todos.php");
                exit();
            } else {
                echo "<script>alert('Error has occured')</script>";
            }
        }
    }
} else {
    header("Location: /dailypomodoro/src/todos/todos.php");
    exit();
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
		<div class="alert alert-danger" role="alert">
			Are you sure you want to delete <?= $result["name"] ?>?
			<a href="todos.php" class="btn btn-secondary">No</a>
			<a href="<?= "delete.php?id={$result["id"]}&confirm=1" ?>" class="btn btn-warning">Yes</a>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
			crossorigin="anonymous"></script>
	</body>
</html>
