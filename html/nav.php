<div class="navSearch"> <!--search bar -->
	<div class="searchInput">
		<label name="search">🔍</label>
		<search><input name="search" type="search"></search>
	</div>
</div>
<div class="navMain"> <!-- menu -->
	<div class="bar">
		<?php if (!$userId): ?>
			<a href="/html/login/singup.php"><button>SINGUP</button></a>
			<a href="/html/login/login.php"><button>LOGIN</button></a>
		<?php else: ?>
			<a class="userNav" href=<?php echo "/?user=$userId"?> >
				<h4><?php echo $userName; ?></h4>
				<img src="https://img.freepik.com/premium-vector/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-vector-illustration_561158-3383.jpg">
			</a>
		<?php endif; ?>
	</div>
	<div class="bar">
		<a href="/#top"><button>HOME</button></a>
	</div>
	<div class="bar">
		<a><button onclick="togleTheme()">settings</button></a>
	</div>
	<?php if ($userId): ?>
		<div class="bar">
			<a href="/html/login/logout.php"><button>LOGOUT</button></a>
		</div>
	<?php endif; ?>
</div>
