<?php
	if (isset($_GET['post'])) {
		$postId = $_GET['post'];

		$sql = "
			SELECT login, content, date, Users.id as user_id, Posts.id
			FROM Posts 
			INNER JOIN Users
			ON Posts.user_id = Users.id
			WHERE Posts.id = $postId;
		";

		$row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
	}

	$userSettings = "";

	$sName = $_SERVER['SERVER_NAME']."/?post=".$row['user_id'];

	//test for owner, if ownership true -> add edit and delete buttons	
	if (isset($_SESSION['id']) && $row['user_id'] === $_SESSION['id']) {
		$userSettings = 
		"
			<button onclick='edit(p".$row['id'].")'>edit</button>
			<button>delete</button>
		";
	}
?>

<div class='post'> <!-- post template -->
	<div class='postHeader'>
		<div class='userFlex postFlex'>
			<img src='https://img.freepik.com/premium-vector/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-vector-illustration_561158-3383.jpg'>
			<h3> <?php echo $row['login'] ?> </h3>
		</div>
		<div class='menuDrop'>
			<button>⁞</button>
			<div>
				<button onclick="copy('<?php echo $sName ?>')">share</button>
				<?php echo $userSettings ?>
			</div>
		</div>
	</div>
	<form id="<?php echo "p".$row['id'] ?>" method="POST"> <!-- form for edit? for test now -->
		<textarea disabled><?php echo $row['content'] ?></textarea>
		<input style="display: none;" type="submit">
	</form>
	<span><?php echo $row['date'] ?></span>
</div>