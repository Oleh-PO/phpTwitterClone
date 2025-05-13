<?php
  $userSettings = "";

  $sName = $_SERVER['SERVER_NAME']."/?post=".$row['id'];

  //test for owner, if ownership true -> add edit and delete buttons
  if ($row['user_id'] === $userId) {
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
		<div class='menuDrop'> <!--drop dawn menu-->
			<button>⁞</button>
			<div>
				<button class="share" onclick="copy('<?php echo $sName ?>')">share</button>
				<?php echo $userSettings ?>
			</div>
		</div>
	</div>
	<p id="<?php echo "p" . $row['id'] ?>" method="POST">
		<!-- content of user post, if user is post owner adds buttons for edit and delete-->
		<textarea disabled><?php echo $row['content'] ?></textarea>
		<button onclick="editRecuest(<?php echo "p" . $row['id'] ?>)" style="display: none;">confirm</button>
	</p>
	<div class="time">
		<span><?php echo $row['date'] ?></span>
	</div>
</div>
