<?php

	require 'init.php';
	$title = "Signup";

	if($_SERVER['REQUEST_METHOD'] == "POST") //Something was posted
	{
		$errors = [];
		$email = addslashes($_POST['email']);
		$first_name = addslashes($_POST['first_name']);
		$last_name = addslashes($_POST['last_name']);
		$username = addslashes($_POST['username']);
		$password = addslashes($_POST['password']);
		$role = addslashes($_POST['role']);

		//validate data
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = "Invalid email";
		}

		if(!preg_match("/^[a-zA-Z]+$/", trim($username))) {
			$errors['username'] = "User name can only have letters without spaces";
		}

		if(!preg_match("/^[a-zA-Z]+$/", trim($first_name)))	{
			$errors['first_name'] = "First name can only have letters without spaces";
		}

		if(!preg_match("/^[a-zA-Z]+$/", trim($last_name))) {
			$errors['last_name'] = "Last name can only have letters without spaces";
		}

		if(empty($errors)){
			$password = password_hash($password, PASSWORD_DEFAULT);
			$query = "INSERT INTO users (username, first_name, last_name, email, password, role, date) VALUES ('$username', '$first_name', '$last_name', '$email', '$password', '$role', NOW())";
			query($query);

			message("Account created successfully! Login to continue");
			redirect("login");
		}
	}
?>

	<?php require 'header.php';?>

		<div class="class_56" style="background-color: transparent;" >
			<div class="class_57" >
				<form method="post" style="height: auto;" enctype="multipart/form-data" class="class_58" >
					<h1 class="class_18"  >
						Signup
					</h1>
					<img src="assets/images/image4.jpg" class="class_59">
					<div style="color:red;padding:10px;">
						<?php
							if(!empty($errors)) {
								echo implode("<br>", $errors);
							} 
						?>
					</div>	
					<div class="class_24" >
						<label class="class_55"  >
							Username
						</label>
						<input value="<?=old_value('username')?>" placeholder="" type="text" name="username" class="class_12" >
					</div>
					<div class="class_24" >
						<label class="class_55"  >
							First Name
						</label>
						<input value="<?=old_value('first_name')?>" placeholder="" type="text" name="first_name" class="class_12" >
					</div>
					<div class="class_24" >
						<label class="class_55"  >
							Last Name
						</label>
						<input value="<?=old_value('last_name')?>" placeholder="" type="text" name="last_name" class="class_12" >
					</div>
					<div class="class_24" >
						<label class="class_55"  >
							Email
						</label>
						<input value="<?=old_value('email')?>" placeholder="" type="text" name="email" class="class_12" >
					</div>
					<div class="class_24" >
						<label class="class_55"  >
							Password
						</label>
						<input value="<?=old_value('password')?>" placeholder="" type="text" name="password" class="class_12" >
					</div>
					<div class="class_24" >
						<label class="class_55"  >
							Retype Password
						</label>
						<input placeholder="" type="text" name="retype_password" class="class_12" >
					</div>
					<div style="margin:auto;display:flex" class="class_24" >
						<div style="flex:1">
							<input type="radio" id="user" name="role" value="user">
							<label for="html">User</label><br>
						</div>
						<div style="flex:1">
							<input type="radio" id="music" name="role" value="music">
							<label for="css">Artist</label><br>
						</div>
					</div>
					<div style="padding:10px;">
						Already have an account? <a href="login.php">Login</a>
					</div>
					<button class="class_60"  >
						Signup
					</button>
				</form>
			</div>
		</div>
 
<?php require 'footer.php';?>