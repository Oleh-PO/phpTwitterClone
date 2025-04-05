<?php 
	session_start();
	$conn = require $_SERVER['DOCUMENT_ROOT'] . "\php\sql.php";//connects to mysql via sql.php file
	$id = $_GET["user"];
	$sql = "
	SELECT login, bio FROM Users
	WHERE	id = '$id';
	";
	$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
	if ($result) {//bio update
	 	$name = $result["login"];
	 	if ($result["bio"]) {
	 		$bio = $result["bio"];
	 	} else {
	 		$bio = "nothing here";
	 	}
	} else {
		die('id not found :(');
	}
	mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?php echo $name; ?> </title>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="stylesheet" type="text/css" href="/css/profile.css">
</head>
<body>
	<nav>
		<?php require 'nav.php'; ?> <!-- adding nav bar -->
	</nav>
	<div class="profile">
		<div class="userFlex">
			<img src="https://img.freepik.com/premium-vector/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-vector-illustration_561158-3383.jpg">
			<h2><?php echo $name; ?></h2>
		</div>
		<div class="bio">
			<h4>bio:</h4>
			<p><?php echo $bio; ?></p>
		</div>
	</div>
</body>
</html>
