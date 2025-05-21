<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/php/log.php";
	$test = new Log;
	$test->singIn();
?>

<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="/css/form.css">
	<script type="text/javascript" src="/js/main.js"></script>
	<script type="text/javascript"><?php $test->jsInit(); ?></script>
</head>
<body>
	<div class="form">
		<form method="POST"> SIGN UP
			<div class="inputDiv <?php $test->invalidTest($test->loginError); ?>">
				<input required minlength="1" maxlength="31" placeholder="nickname" autocomplete="nickname" type="text" id="nickname" name="login" <?php $test->formTest($test->login); ?>>
			</div>
			<div class="inputDiv <?php $test->invalidTest($test->emailError); ?>">
				<input required minlength="1" maxlength="31" placeholder="email" autocomplete="email" type="email" id="email" name="email" <?php $test->formTest($test->email); ?>>
			</div>
			<div class="inputDiv <?php $test->invalidTest($test->passwordError); ?>">
				<input required minlength="7" maxlength="15" placeholder="password" autocomplete="new-password" type="password" name="password" id="password" <?php $test->formTest($test->password); ?>>
			</div>
			<div class="inputDiv <?php $test->invalidTest($test->confirmError); ?>">
				<input required minlength="7" maxlength="15" placeholder="confirm password" autocomplete="new-password" type="password" name="passCon" id="passCon" <?php $test->formTest($test->passcon); ?>>
			</div>
			<input type="submit">
			<?php if (isset($test->error)): ?>
				<span><?php echo ($test->getErrorMessage($test->error)); ?></span>
			<?php endif; ?>
		</form>
		<div>
			<a href="/">HOME</a>
			<a href="/html/login/login.php">LOG IN</a>
		</div>
	</div>
</body>
</html>
