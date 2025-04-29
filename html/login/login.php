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

		if($result > 0) {
			if (password_verify($password, $result["password"])) {

				$_SESSION["id"] 			= $result["id"];
				$_SESSION["username"] = $result["login"];//start session

				header("Location: /");
				exit();
			}
		}
		mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOG IN</title>
	<link rel="stylesheet" type="text/css" href="/css/form.css">
	<script type="text/javascript" src="js/theme.js"></script>
	<script type="text/javascript">
		<?php if (isset($_COOKIE['toggleTheme'])): ?>
			toggleTheme(<?php echo $_COOKIE['toggleTheme'] ?>);
		<?php endif; ?>
	</script>
</head>
<body>
	<div class="form"> 
		<form method="POST"> LOG IN
			<input required minlength="1" maxlength="31" placeholder="login or email" autocomplete="username" type="text" id="login" name="login">
			<input required minlength="7" maxlength="15" placeholder="password" autocomplete="current-password" type="password" name="password" id="password">
			<input type="submit">
		</form>
		<div>
			<a href="/">HOME</a>
			<a href="/html/login/singup.php">SIGN UP</a>
		</div>
	</div>
</body>
</html>
