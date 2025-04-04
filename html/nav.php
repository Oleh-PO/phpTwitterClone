<?php 
	session_start();
 ?>
<div class="navSearch"> <!--search bar -->
	<div class="searchInput">
		<label name="search">🔍</label>
		<input name="search" type="text">
	</div>
</div>
<div class="navMain"> <!-- menu -->
	<div class="account">
		<?php if (isset($_SESSION["id"])): ?>
			<a href="html/login/logout.php">LOGOUT</a>
		<?php else: ?>
			<a href="html/login/singup.php">SINGUP</a>
			<a href="html/login/login.php">LOGIN</a>
		<?php endif; ?>
	</div>
	<div class="discover">
		<ul>
			<li>HOME</li>
			<li>FRIANDS</li>
			<li>SETTINGS</li>
		</ul>
	</div>
</div>
