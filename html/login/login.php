<?php 
	require $_SERVER['DOCUMENT_ROOT'] . "\php\init.php";
	init();

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		$login    = $_POST["login"];
		$password = $_POST["password"];

		$sql = "
			SELECT id, password, login FROM Users
			WHERE login = '$login' OR email = '$login';
		";
		$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
		if (password_verify($password, $result["password"])) {
			var_dump($result["id"]);
			$_SESSION["id"] 			= $result["id"];
			$_SESSION["username"] = $result["login"];

			header("Location: /");
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
			<input placeholder="password" autocomplete="current-password" type="password" name="password" id="password">
			<input type="submit">
		</form>
		<a href="/">HOME</a>
		<a href="/html/login/singup.php">SINGUP</a>
	</div>
</body>
</html>
