<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/php/init.php";
	$user = new user;
	$user->connect();//initiating a session and mySQL
	// https();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<title>
		<?php	echo "twitter";	?>
	</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/theme.js"></script>
		<script type="text/javascript">
			let userId = false;
			<?php if ($user->getUserId): ?>
				userId = "user=<?php echo $user->getUserId ?>";
			<?php endif; ?>
			<?php if (isset($_COOKIE['toggleTheme'])): ?>
				toggleTheme(<?php echo $_COOKIE['toggleTheme'] ?>);
			<?php endif; ?>
		</script>
	<script type="text/javascript" src="js/feed.js"></script>
	<script type="text/javascript" src="js/fileMeneger.js"></script>
</head>
<body>
	<nav>
		<?php require 'html/nav.php'; ?> <!-- adding nav bar -->
	</nav>
	<main>
		<?php if ($user->getUserId) {require 'html/profile.php';} ?><!-- adding profile-->
		<div class="container">
			<?php if ($user->userId) {createPost();} ?><!-- adding create post menu -->
			<div onclick="changeOrder()" class="sort">
				<button class="sortButton" id="checkbox">sort</button><!--△▽-->
			</div>
			<div class="postContainer"> 
				<?php
					if ($user->postId) {
						//test for GET "post" if true puts additional template
						pullPost();
					}
				?>
			</div>
		</div>
		<div class="bottom"></div>
	</main>
</body>
</html>
