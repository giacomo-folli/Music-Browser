<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$title?> | <?=APP_NAME?></title>
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
		<link rel="icon" type="image/x-icon" href="assets/images/attachment_123775517.jpg">
		<link rel="shortcut icon" type="image/x-icon" href="assets/images/attachment_123775517.jpgo">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">		
		<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
	</head>
<body>
	<header class="class_1" >
		<div class="class_2" style="max-width:60px; height:auto;">
			<img src="assets/images/attachment_123775517.jpg" class="class_3" >
		</div>

		<input type="checkbox" id="click">

		<div  class="item_class_0 class_4">
			<div class="menubar class_6">
				<?php if(is_logged_in()): ?>
					<a href="index.php" class="class_7"  >
						Home
					</a>
					<a href="artists.php" class="class_7"  >
						Artists
					</a>
					<a href="profile<?=get_role()?>.php" class="class_7"  >
						Profile
					</a>	
				<?php endif; ?>
				<?php if(get_role() == ''): ?>
					<a href="upload.php" class="class_7"  >
						Upload
					</a>
				<?php endif; ?>
				<a href="info.php" class="class_7"  >
					About us
				</a>	
				<?php if(is_admin()): ?>
					<a href="admin/admin.php" class="class_7"  >
						Admin
					</a>	
				<?php endif; ?>	
			</div>

			<div class="dropdown class_6">
				<a href="index.php" class="class_7">Home</a>
				<a href="artists.php" class="class_7">Artists</a>
				<?php if(get_role() == ''): ?>
					<a href="upload.php" class="class_7">Upload</a>
				<?php endif; ?>
				<?php if(is_logged_in()): ?>
					<a href="profile<?=get_role()?>.php" class="class_7">Profile</a>	
				<?php endif; ?>
				<a href="info.php" class="class_7">About us</a>	
				<?php if(is_admin()): ?>
					<a href="admin/admin.php" class="class_7">Admin</a>	
				<?php endif; ?>	
			</div>

		</div>

		<label for="click" class="menu-btn">
			<i class="fa fa-bars"></i>
		</label>
		
		<div class="class_8" style="border-radius: 7px;margin: 5px 5px 0px 0px;">
			<?php if(is_logged_in()):?>
				<img src="<?=get_image(user('image'))?>" class="class_9" >
				<div>Hi, <?=user('username')?>
					<a style="width:100%; display:block;" href="logout.php">[Logout]</a>
				</div>
			<?php else:?>
				<a href="login.php" class="class_7_login">Login</a>
			<?php endif;?>
		</div>
	</header>