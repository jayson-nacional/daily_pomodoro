<?php

use JaysonNacional\DailyPomodoro\classes\Database;

if (isset($_GET["logout"]) && $_GET["logout"]) {
    header("Location: /dailypomodoro/logout.php");
    exit();
}

// Auth
include dirname(__DIR__, 1) . "/includes/auth.php";
// End of Auth flow

$pdo = Database::connect();
$statement = $pdo->query("SELECT * FROM todos");
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

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
		<a href="add.php" class="btn btn-primary">Add Task</a>
		<a href="todos.php?logout=1" class="btn btn-secondary">Logout</a>

		<?php foreach ($result as $row): ?>
			<div class="card">
				<div class="card-body">
					<a href="<?php echo "edit.php?id={$row['id']}"; ?>" class="btn btn-success">Edit</a>
					<a href="<?php echo "delete.php?id={$row['id']}"; ?>"  class="btn btn-danger">Delete</a>
					<?= $row["name"] ?>	
				</div>
			</div>
		<?php endforeach; ?>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
			crossorigin="anonymous"></script>
	</body>
</html>
