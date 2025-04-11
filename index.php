<?php
	session_start();
	$conn = require $_SERVER['DOCUMENT_ROOT'] . "\php\sql.php";//connects to mysql via sql.php file
	if (isset($_SESSION["id"])) {
		$id    = $_SESSION["id"];
		$title = $_SESSION["username"];
	} else {
		$id    = 0;
		$title = "unknown";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php echo $title; ?>
	</title>
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript">
			let user = false;
			<?php if (isset($_GET['user'])): ?>
				user = "user=" + <?php echo $_GET['user'] ?>;
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
		<?php if (isset($_GET['user'])){require 'html/profile.php';} ?>
		<div class="container">
			<?php require $_SERVER['DOCUMENT_ROOT'] . "\html\post.php" ?>
			<button onclick="loadPost()">test</button> <!-- test buttons -->
			<button onclick="changeOrder()" id="checkbox">order</button>
			<div class="postContainer"> 
				<?php if (isset($_GET['post'])) { 
					//test for GET "post" if true puts additional template
					require $_SERVER['DOCUMENT_ROOT']."/html/postTemplate.php";
				} ?>
			</div>
		</div>
		<div class="bottom"></div>
	</main>
</body>
</html>
<?php mysqli_close($conn); ?>