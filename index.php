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

        use Dotenv\Dotenv;

		include __DIR__ . "/vendor/autoload.php";

		$dotnev = Dotenv::createImmutable(__DIR__);
		$dotnev->load();

		try {
		    $pdo = new PDO(dsn: $_ENV["DSN"], username: $_ENV["USER_NAME"], password: $_ENV["PASSWORD"]);
		    $query = $pdo->query("SELECT * FROM todos");
		    $result = $query->fetchAll(PDO::FETCH_ASSOC);

		    foreach ($result as $row) {
		        echo $row['name'], "</br>";
		    }

		} catch (Exception $e) {
		    echo $e->getMessage();
		}
		?>

		<div class="card">
			<div class="card-body">
				Task 1
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				Task 2
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				Task 3
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
			crossorigin="anonymous"></script>
	</body>
</html>
