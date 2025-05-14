<?php 
	require $_SERVER['DOCUMENT_ROOT'] . "/php/init.php";
	require $_SERVER['DOCUMENT_ROOT'] . "/php/log.php";
	$user->init();
	start();
?>

<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOG IN</title>
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
		<form method="POST"> LOG IN
			<div class="inputDiv <?php invalidTest($loginError); ?>">
				<input required minlength="1" maxlength="31" placeholder="login or email" autocomplete="username" type="text" id="login" name="login" <?php formTest($login); ?>>
			</div>
			<div class="inputDiv <?php invalidTest($passwordError); ?>">
				<input required minlength="7" maxlength="15" placeholder="password" autocomplete="current-password" type="password" name="password" id="password" <?php formTest($password); ?>>
			</div>
			<input type="submit">
			<?php if (isset($error)): ?>
				<span><?php echo $errorMessage[$error]; ?></span>
			<?php endif; ?>
		</form>
		<div>
			<a href="/">HOME</a>
			<a href="/html/login/singup.php">SIGN UP</a>
		</div>
	</div>
</body>
</html>
