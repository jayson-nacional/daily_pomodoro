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
		<?php

			use JaysonNacional\DailyPomodoro\classes\Database;

			include __DIR__ . "/vendor/autoload.php";

			$pdo = Database::connect();
			$query = $pdo->query("SELECT * FROM todos");
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
		?>

		<?php foreach ($result as $row): ?>
			<div class="card">
				<div class="card-body">
					<?= $row["name"] ?>
				</div>
			</div>
		<?php endforeach; ?>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
			crossorigin="anonymous"></script>
	</body>
</html>
