<?php
	session_start();
	$conn = require $_SERVER['DOCUMENT_ROOT'] . "\php\sql.php";//connects to mysql via sql.php file
	if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_SESSION["id"])) {
		$id    = $_SESSION["id"];
		$story = $_POST["story"];

		if (strlen($story) > 0) {//creating a post
			$sql = "
				INSERT INTO Posts (user_id, content)
				VALUES ('$id', '$story');
			";
			mysqli_query($conn, $sql);
			header('Location: /index.php');
			exit;
		}
	}
	mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TEST</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<nav>
		<?php require 'html/nav.php'; ?> <!-- adding nav bar -->
	</nav>
	<main>
		<div class="container">
			<br><br><br><br>
			<div class="createPost"> <!-- test for post -->
				<form method="POST">
					<textarea id="story" name="story" rows="5" cols="33"></textarea>
					<input type="submit" name="submit">
				</form>
			</div>
		</div>
	</main>
</body>
</html>