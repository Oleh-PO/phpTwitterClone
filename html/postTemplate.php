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

	$sName = $_SERVER['SERVER_NAME']."/?post=".$row['id'];

	//test for owner, if ownership true -> add edit and delete buttons	
	if (isset($_SESSION['id']) && $row['user_id'] === $_SESSION['id']) {
		$userSettings = 
		"
			<button onclick='edit(p".$row['id'].")'>edit</button>
			<button onclick='deletePost(".$row['id'].")'>delete</button>
		";
	}
?>

<div class='post'> <!-- post template -->
	<div class='postHeader'>
		<a href="<?php echo '/?user=' . $row['user_id']?>">
			<div class='userFlex postFlex'>
				<img src='https://img.freepik.com/premium-vector/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-vector-illustration_561158-3383.jpg'>
				<h3> <?php echo $row['login'] ?> </h3>
			</div>
		</a>
		<div class='menuDrop'>
			<button>⁞</button>
			<div>
				<button onclick="copy('<?php echo $sName ?>')">share</button>
				<?php echo $userSettings ?>
			</div>
		</div>
	</div>
	<p id="<?php echo "p" . $row['id'] ?>" method="POST"> <!-- form for edit? for test now -->
		<textarea disabled><?php echo $row['content'] ?></textarea>
		<button onclick="editRecuest(<?php echo "p" . $row['id'] ?>)" style="display: none;">edit</button>
	</p>
	<span><?php echo $row['date'] ?></span>
</div>
