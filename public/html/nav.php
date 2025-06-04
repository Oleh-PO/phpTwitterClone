<div class="navMain"> <!-- menu -->
	<div class="bar userbar">
		<?php if (!$this->userId): ?>
			<a href="/html/login/singup.php"><button>SIGN UP</button></a>
			<a href="/html/login/login.php"><button>LOG IN</button></a>
		<?php else: ?>
			<a class="userNav" href=<?php echo "/?user=$this->userId"?> >
				<h4><?php echo $user->userName; ?></h4>
				<img src="https://img.freepik.com/premium-vector/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-vector-illustration_561158-3383.jpg">
			</a>
		<?php endif; ?>
	</div>
	<div class="bar">
		<a href="/"><button>HOME</button></a>
	</div>
	<div class="bar settingsMenu">
		<a><button onclick="">SETTINGS</button></a>
		<div class="settings">
			<div onchange="toggleTheme(theme.checked)"><!-- theme toggle -->
				<label tabindex="0" class="toggle" for="theme">
					<p>darkMod</p>
					<div>
						<input <?php if(isset($_COOKIE['toggleTheme'])){echo "checked";}?> type="checkbox" id="theme">
						<span></span>
					</div>
				</label>
			</div>
		</div>
	</div>
	<?php if ($this->userId): ?>
		<div class="bar">
			<a href="/html/login/logout.php"><button>LOG OUT</button></a>
		</div>
	<?php endif; ?>
</div>
