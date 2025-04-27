<?php 

	$sql = "
	SELECT bio FROM Users
	WHERE	id = '$getUserId';
	";

	$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

	if ($result) { //get user bio from mySQL
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
		<h2><?php echo $getUserName; ?></h2>
	</div>
	<div class="bio">
		<div id="bio" method="POST">
			<textarea disabled name="bio" class="edit"><?php echo $bio; ?></textarea>
			<button style="display: none;" onclick="editRecuest(bio)">confirm</button>
		</div>
		<?php if ($userId === $getUserId): ?> <!-- if user is owner add button that allows to edit bio -->
			<button onclick="edit(bio)">¶</button>
		<?php endif ?>
	</div>
</div>
