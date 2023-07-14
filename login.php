<?php

	require 'init.php';
	$title = "Login";

	if($_SERVER['REQUEST_METHOD'] == "POST") //Something was posted
	{
		$errors = [];
		$email = addslashes($_POST['email']);
		$password = addslashes($_POST['password']);

		$query = "SELECT * FROM users WHERE email = '$email' limit 1";
		$row = query($query);

		if(!empty($row)){
			$row = $row[0];

			//read
			if(password_verify($password, $row['password'])) {
				//authenticate
				auth($row);
				redirect("profile");
			} else {
				$errors['email'] = "Invalid email or password";
			}
		} else {
			$errors['email'] = "Invalid email or password";
		}
	}
?>

	<?php require 'header.php';?>

		<div class="class_56" style="background-color: transparent;" >
			<div class="class_57">
				<form method="post" enctype="multipart/form-data" class="class_58"  style="height:auto" >
					<h1 class="class_18"  >
						Login
					</h1>
					<img src="assets/images/image4.jpg" class="class_59" >

					<div style="color:red;padding:10px;">
						<?php
							if(!empty(message())) {
								echo message("", true);
							} 
						?>
					</div>	

					<div style="color:red;padding:10px;">
						<?php
							if(!empty($errors)) {
								echo implode("<br>", $errors);
							} 
						?>
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
						<input value="<?=old_value('password')?>" placeholder="" type="password" name="password" class="class_12" >
					</div>
					<div style="padding:10px;">
						Don't have an account? <a href="signup.php">Sign Up</a>
					</div>
					<button class="class_60" style="margin-bottom: 20px;" >
						Login
					</button>
				</form>
			</div>
		</div>
 
<?php require 'footer.php';?>