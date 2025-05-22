<div class="profile">
	<div class="userFlex">
		<img src="https://img.freepik.com/premium-vector/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-vector-illustration_561158-3383.jpg">
		<h2><?php echo $user->getUserName; ?></h2>
	</div>
	<div class="bio">
		<div id="bio" method="POST">
			<textarea disabled name="bio" class="edit"><?php echo $user->getBio(); ?></textarea>
			<button style="display: none;" onclick="editRecuest(bio)">confirm</button>
		</div>
		<?php if ($user->userId === $user->getUserId): ?> <!-- if user is owner add button that allows to edit bio -->
			<button onclick="edit(bio)">¶</button>
		<?php endif ?>
	</div>
</div>
