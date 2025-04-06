<?php 
	session_start();
 ?>
<div class="navSearch"> <!--search bar -->
	<div class="searchInput">
		<label name="search">🔍</label>
		<input name="search" type="search">
	</div>
</div>
<div class="navMain"> <!-- menu -->
	<div class="account">
		<?php if (!isset($_SESSION["id"])): ?>
			<a href="/html/login/singup.php">SINGUP</a>
			<a href="/html/login/login.php">LOGIN</a>
		<?php else: ?>
			<a href=<?php echo "/?user=" . $_SESSION["id"]?>  class="user">
				<?php echo $_SESSION["username"]; ?>
				<img src="https://img.freepik.com/premium-vector/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-vector-illustration_561158-3383.jpg">
			</a>
		<?php endif; ?>
	</div>
	<div class="discover">
		<ul>
			<li><a href="/">HOME</a></li>
			<li>FRIANDS</li>
			<li>SETTINGS</li>
		</ul>
	</div>
	<?php if (isset($_SESSION["id"])): ?>
		<a href="/html/login/logout.php">LOGOUT</a>
	<?php endif; ?>
</div>