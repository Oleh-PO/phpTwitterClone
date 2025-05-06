<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/php/init.php";
	require $_SERVER['DOCUMENT_ROOT'] . "/html/login/loginFun.php";
	init();

	$login    = false;
	$email    = false;
	$password = false;
	$passcon  = false;

  if ($_SERVER['REQUEST_METHOD'] === "POST") { //validate form
		$login    = $_POST["login"];
		$email    = $_POST["email"];
		$password = $_POST["password"];
		$passcon  = $_POST["passCon"];

		if (validation()) {

			$sql = "
				INSERT INTO Users (login, email, password)
				VALUES ('$login', '$email', '$hash');
			";

			if (mysqli_query($conn, $sql)) {

				$sql = "
					SELECT id FROM Users
					WHERE login = '$login';
	      ";

	      $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

				$_SESSION["id"] 			= $result["id"];
				$_SESSION["username"] = $login;//start session

				header("Location:/");
				exit();
			} else {
				var_dump("error");
			}
		}
  }
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="/css/form.css">
	<script type="text/javascript" src="/js/theme.js"></script>
	<script type="text/javascript">
		<?php if (isset($_COOKIE['toggleTheme'])): ?>
			toggleTheme(<?php echo $_COOKIE['toggleTheme'] ?>);
		<?php endif; ?>
	</script>
</head>
<body>
	<div class="form">
		<form method="POST"> SIGN UP
			<div class="inputDiv <?php invalidTest($loginError); ?>">
				<input required minlength="1" maxlength="31" placeholder="nickname" autocomplete="nickname" type="text" id="nickname" name="login" <?php formTest($login); ?>>
			</div>
			<div class="inputDiv <?php invalidTest($emailError); ?>">
				<input required minlength="1" maxlength="31" placeholder="email" autocomplete="email" type="email" id="email" name="email" <?php formTest($email); ?>>
			</div>
			<div class="inputDiv <?php invalidTest($passwordError); ?>">
				<input required minlength="7" maxlength="15" placeholder="password" autocomplete="new-password" type="password" name="password" id="password" <?php formTest($password); ?>>
			</div>
			<div class="inputDiv <?php invalidTest($confirmError); ?>">
				<input required minlength="7" maxlength="15" placeholder="confirm password" autocomplete="new-password" type="password" name="passCon" id="passCon" <?php formTest($passcon); ?>>
			</div>
			<input type="submit">
			<?php if (isset($error)): ?>
				<span><?php echo $errorMessage[$error]; ?></span>
			<?php endif; ?>
		</form>
		<div>
			<a href="/">HOME</a>
			<a href="/html/login/login.php">LOG IN</a>
		</div>
	</div>
</body>
</html>
