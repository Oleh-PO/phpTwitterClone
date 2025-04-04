<?php 
	$conn = require $_SERVER['DOCUMENT_ROOT'] . "\php\sql.php";//connects to mysql via sql.php file

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		$login    = $_POST["login"];
		$password = $_POST["password"];

		$sql = "
			SELECT id, password FROM Users
			WHERE login = '$login' OR email = '$login';
		";
		$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
		if (password_verify($password, $result["password"])) {
			session_start();
			var_dump($result["id"]);
			$_SESSION["id"] = $result["id"];
			header("Location: /index.php");
			exit();
		}
		mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="stylesheet" type="text/css" href="/css/form.css">
</head>
<body>
	<div class="form"> 
		<form method="POST"> POST form
			<input placeholder="login or email" autocomplete="username" type="text" id="login" name="login">
			<input placeholder="password" autocomplete="new-password" type="password" name="password" id="password">
			<input type="submit">
		</form>
	</div>
</body>
</html>