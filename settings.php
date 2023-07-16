<?php

	require 'init.php';
	$title = "Settings";

	if(!is_logged_in())
		redirect('login');

	$id = user('id');
	$query = "SELECT * FROM users WHERE id = '$id' LIMIT 1";
	$row = query($query);

	if(!empty($row)) 
		$row = $row[0];

	if($_SERVER['REQUEST_METHOD'] == "POST") //Something was posted
	{
		$errors = [];
		$email = addslashes($_POST['email']);
		$first_name = addslashes($_POST['first_name']);
		$last_name = addslashes($_POST['last_name']);
		$username = addslashes($_POST['username']);
		$password = addslashes($_POST['password']);

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

		$folder = "uploads/";
		if(!file_exists($folder))
		{
			mkdir($folder, 0777, true);
		}

		$image_str = $password_str = "";

		if(!empty($_FILES['image']['name']))
		{
			$allowed = ['image/jpeg','image/png','image/webp'];

			if(in_array($_FILES['image']['type'], $allowed))
			{
				$image = $folder . $_FILES['image']['name'];
				$image_str = ", image = '$image' ";
			} 
			else 
			{
				$errors['image'] = "Image type not supported";
			}	
		} 

		if(empty($errors)){
			//update user
			if(!empty($password))
			{
				$password = password_hash($password, PASSWORD_DEFAULT);
				$password_str = ", password='$password' ";
			}

			if(!empty($image))
			{
				move_uploaded_file($_FILES['image']['tmp_name'], $image);
				if(file_exists($row['image']))
					unlink($row['image']);
			}	
			
			$query = "UPDATE users SET username='$username', first_name='$first_name', last_name='$last_name', email='$email' $password_str $image_str WHERE id='$id' LIMIT 1;";
			query($query);

			$query = "SELECT * FROM users WHERE id = '$id' LIMIT 1";
			$row = query($query);

			if(!empty($row)) 
			{
				auth($row[0]);
			}

			message("Account updated successfully!");
			redirect("profile");
		}
	}
?>

<?php require 'header.php';?>

<div class="class_51" >
	<h1 class="class_52"  >
		Artist Settings
		<br>
	</h1>
	<form method="post" enctype="multipart/form-data" class="class_53"  style="padding: 10px;">
		<div class="class_54" >
			<img src="<?=get_image($row['image'])?>" class="js-image class_27" >
			<input onchange="display_image(this.files[0])" type="file" name="image" class="class_28">
		</div>
		<div class="class_24" >
			<label class="class_55"  >
				Username
			</label>
			<input value="<?=old_value('username', $row['username'])?>" placeholder="" type="text" name="username" class="class_12" >
		</div>
		<div class="class_24" >
			<label class="class_55"  >
				First Name
			</label>
			<input value="<?=old_value('first_name', $row['first_name'])?>" placeholder="" type="text" name="first_name" class="class_12" >
		</div>
		<div class="class_24" >
			<label class="class_55"  >
				Last Name
			</label>
			<input value="<?=old_value('last_name', $row['last_name'])?>" placeholder="" type="text" name="last_name" class="class_12" >
		</div>
		<div class="class_24" >
			<label class="class_55"  >
				Email
			</label>
			<input value="<?=old_value('email', $row['email'])?>" placeholder="" type="text" name="email" class="class_12" >
		</div>
		<div class="class_24" >
			<label class="class_55"  >
				Password
			</label>
			<input placeholder="Leave empty to keep old password" type="text" name="password" class="class_12" >
		</div>
		<div class="class_31" >
			<button class="class_32"  >
				Save
			</button>
			<a href="profile.php" class="class_33"  >
				<button type="button" class="class_33"  >
					Cancel
				</button>
			</a>
			<div class="class_34" >
			</div>
		</div>
	</form>
</div>
 
<?php require 'footer.php';?>

<script>
	function display_image(file)
	{
		document.querySelector('.js-image').src = URL.createObjectURL(file);
	}
</script>