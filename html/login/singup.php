<?php
	require $_SERVER['DOCUMENT_ROOT'] . "\php\init.php";
	init();

	function validInput($input, $type, ) { //test for uniqueness
		global $conn;
		$length = strlen($input);

		if ($length > 0 && $length < 31) {
			$sql = "
			SELECT $type FROM Users
			WHERE $type = '$input';
      ";
      $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
      return !is_array($result);
		}
	}

  if ($_SERVER['REQUEST_METHOD'] === "POST") { //validate form
		$login    = $_POST["login"];
		$email    = $_POST["email"];
		$password = $_POST["password"];
		$passcon  = $_POST["passCon"];

		if (validInput($login, "login") && validInput($email, "email")) {

      if (strlen($password) > 7 && strlen($password) < 15 && $password === $passcon) {
      	$hash = password_hash($password, PASSWORD_DEFAULT);

				$sql = "
					INSERT INTO Users (login, email, password)
					VALUES ('$login', '$email', '$hash');
				";

				if (mysqli_query($conn, $sql)) {
					header("Location: /");
					exit();
				} else {
					die("error");
				}
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
</head>
<body>
	<div class="form">
		<form method="POST"> SIGN UP
			<input required minlength="1" maxlength="31" placeholder="login" autocomplete="nickname" type="text" id="login" name="login">
			<input required minlength="1" maxlength="31" placeholder="email" autocomplete="email" type="email" id="email" name="email">
			<input required minlength="7" maxlength="15" placeholder="password" autocomplete="new-password" type="password" name="password" id="password">
			<input required minlength="7" maxlength="15" placeholder="confirm password" autocomplete="new-password" type="password" name="passCon" id="passCon">
			<input type="submit">
		</form>
		<div>
			<a href="/">HOME</a>
			<a href="/html/login/login.php">LOG IN</a>
		</div>
	</div>
</body>
</html>
