<?php 
	require $_SERVER['DOCUMENT_ROOT'] . "/php/log.php";
	$test = new Log;
	$test->logIn();
?>

<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOG IN</title>
	<link rel="stylesheet" type="text/css" href="/css/form.css">
	<script type="text/javascript" src="/js/main.js"></script>
	<script type="text/javascript"><?php $test->jsInit(); ?></script>
</head>
<body>
	<div class="form"> 
		<form method="POST"> LOG IN
			<div class="inputDiv <?php $test->invalidTest($test->loginError); ?>">
				<input required minlength="1" maxlength="31" placeholder="login or email" autocomplete="username" type="text" id="login" name="login" <?php $test->formTest($test->login); ?>>
			</div>
			<div class="inputDiv <?php $test->invalidTest($test->passwordError); ?>">
				<input required minlength="7" maxlength="15" placeholder="password" autocomplete="current-password" type="password" name="password" id="password" <?php $test->formTest($test->password); ?>>
			</div>
			<input type="submit">
			<?php if (isset($test->error)): ?>
				<span><?php echo ($test->getErrorMessage($test->error)); ?></span>
			<?php endif; ?>
		</form>
		<div>
			<a href="/">HOME</a>
			<a href="/html/login/singup.php">SIGN UP</a>
		</div>
	</div>
</body>
</html>
