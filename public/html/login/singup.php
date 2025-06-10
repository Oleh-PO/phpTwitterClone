<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/php/class/preload.php";
	$load = new preload;
	$log = new log;
	$log->singIn();
?>

<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="/css/form.css">
	<script type="text/javascript" src="/js/main.js"></script>
	<script type="text/javascript"><?php $log->jsInit(); ?></script>
</head>
<body>
	<div class="form">
		<form method="POST"> SIGN UP
			<div class="inputDiv <?php $log->invalidTest($log->loginError); ?>">
				<input required minlength="1" maxlength="31" placeholder="nickname" autocomplete="nickname" type="text" id="nickname" name="login" <?php $log->formTest($log->login); ?>>
			</div>
			<div class="inputDiv <?php $log->invalidTest($log->emailError); ?>">
				<input required minlength="1" maxlength="31" placeholder="email" autocomplete="email" type="email" id="email" name="email" <?php $log->formTest($log->email); ?>>
			</div>
			<div class="inputDiv <?php $log->invalidTest($log->passwordError); ?>">
				<input required minlength="7" maxlength="15" placeholder="password" autocomplete="new-password" type="password" name="password" id="password" <?php $log->formTest($log->password); ?>>
			</div>
			<div class="inputDiv <?php $log->invalidTest($log->confirmError); ?>">
				<input required minlength="7" maxlength="15" placeholder="confirm password" autocomplete="new-password" type="password" name="passCon" id="passCon" <?php $log->formTest($log->passcon); ?>>
			</div>
			<input type="submit">
			<?php if (isset($log->error)): ?>
				<span><?php echo ($log->getErrorMessage($log->error)); ?></span>
			<?php endif; ?>
		</form>
		<div>
			<a href="/">HOME</a>
			<a href="/html/login/login.php">LOG IN</a>
		</div>
	</div>
</body>
</html>
