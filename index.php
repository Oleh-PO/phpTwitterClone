<?php
	session_start();
	$conn = require $_SERVER['DOCUMENT_ROOT'] . "\php\sql.php";//connects to mysql via sql.php file
	if (isset($_SESSION["id"])) {
		$id    = $_SESSION["id"];
		$title = $_SESSION["username"];

		if ($_SERVER['REQUEST_METHOD'] === "POST") {
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
	} else {
		$id    = 0;
		$title = "test";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php echo $title; ?>
	</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<?php if (isset($_GET['user'])): ?>
		<link rel="stylesheet" type="text/css" href="css/profile.css">
	<?php endif; ?>
	<script type="text/javascript"> 
		let count = 1; //delete for letter 
		const test = function() {
			let container = document.querySelector(".container");
			let xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					container.innerHTML += this.responseText;
					count++;
				}
			};
			xmlhttp.open("GET", "/test.php?q="+count, true);
			xmlhttp.send();
		};
	</script>
</head>
<body>
	<nav>
		<?php require 'html/nav.php'; ?> <!-- adding nav bar -->
	</nav>
	<main>
		<?php if (isset($_GET['user'])){require 'html/profile.php';} ?>
		<div class="container">
			<div class="createPost"> <!-- test for post -->
				<form method="POST">
					<textarea id="story" name="story" rows="5" cols="33"></textarea>
					<input type="submit" name="submit">
				</form>
			</div>
			<button onclick="test()">test</button>
			<?php require 'php/feed.php'; ?> <!-- delete to -->
		</div>
	</main>
</body>
</html>
<?php mysqli_close($conn); ?>