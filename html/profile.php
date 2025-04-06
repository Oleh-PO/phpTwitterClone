<?php 
	$profile_id = $_GET["user"];
	$sql = "
	SELECT login, bio FROM Users
	WHERE	id = '$profile_id';
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
?>
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
