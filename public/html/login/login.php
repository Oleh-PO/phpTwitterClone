<?php 
	require $_SERVER['DOCUMENT_ROOT'] . "/php/class/log.php";
	$log = new Log;
	$log->logIn();
?>

<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOG IN</title>
	<link rel="stylesheet" type="text/css" href="/css/form.css">
	<script type="text/javascript" src="/js/main.js"></script>
	<script type="text/javascript"><?php $log->jsInit(); ?></script>
</head>
<body>
	<div class="form"> 
		<form method="POST"> LOG IN
			<div class="inputDiv <?php $log->invalidTest($log->loginError); ?>">
				<input required minlength="1" maxlength="31" placeholder="login or email" autocomplete="username" type="text" id="login" name="login" <?php $log->formTest($log->login); ?>>
			</div>
			<div class="inputDiv <?php $log->invalidTest($log->passwordError); ?>">
				<input required minlength="7" maxlength="15" placeholder="password" autocomplete="current-password" type="password" name="password" id="password" <?php $log->formTest($log->password); ?>>
			</div>
			<input type="submit">
			<?php if (isset($log->error)): ?>
				<span><?php echo ($log->getErrorMessage($log->error)); ?></span>
			<?php endif; ?>
		</form>
		<div>
			<a href="/">HOME</a>
			<a href="/html/login/singup.php">SIGN UP</a>
		</div>
	</div>
</body>
</html>
