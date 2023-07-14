<?php

	require 'init.php';
	$title = "Upload";

	if($_SERVER['REQUEST_METHOD'] == "POST") //Something was posted
	{
		$errors = [];
		$title = addslashes($_POST['title']);

		if(empty($title))
		{
			$errors['title'] = "Title is required";
		}

		$folder = "uploads/";
		if(!file_exists($folder))
		{
			mkdir($folder, 0777, true);
		}

		if(!empty($_FILES['file']['name']))
		{
			$allowed = ['audio/mpeg'];
			if(in_array($_FILES['file']['type'], $allowed))
			{
				$file = $folder . $_FILES['file']['name'];
			} else {
				$errors['file'] = "Audio file not supported";
			}
		} else {
			$errors['file'] = "Audio file is required";	
		}

		if(!empty($_FILES['image']['name']))
		{
			$allowed = ['image/jpeg','image/png','image/webp'];
			if(in_array($_FILES['image']['type'], $allowed))
			{
				$image = $folder . $_FILES['image']['name'];
			} else {
				$errors['image'] = "Only png, jpeg and webp images are allowed";
			}
		} else {
			$errors['image'] = "Image is required";	
		}

		if(empty($errors)){
			$user_id = user('id');

			if(!empty($image))
				move_uploaded_file($_FILES['image']['tmp_name'], $image);	
			if(!empty($file))
				move_uploaded_file($_FILES['file']['tmp_name'], $file);	

			$query = "INSERT INTO songs (user_id, file, image, title, date) VALUES ('$user_id', '$file', '$image', '$title', NOW())";
			query($query);

			message("Your song successfully added! Login to continue");
			redirect("profile");
		}
	} 	
?>

<?php require 'header.php';?>

<div class="class_22" >
	<form method="post" enctype="multipart/form-data" class="class_23" >
		<h1 class="class_18"  >
			Upload Song
		</h1>
		<div style="color:red;padding:10px;">
			<?php
				if(!empty($errors)) {
					echo implode("<br>", $errors);
				} 
			?>
		</div>
		<div class="class_24" >
			<label class="class_25"  >
				Title
			</label>
			<input value="<?=old_value('title')?>" placeholder="" type="text" name="title" class="class_12" >
		</div>
		<div class="class_26" >
			<img src="<?=get_image('')?>" class="js-image class_27" >
			<input onchange="display_image(this.files[0])" type="file" name="image"  class="class_28">
		</div>
		<div class="class_26" >
			<div class="class_29" >
				<audio controls="" class="js-file class_30" >
					<source src="" type="audio/mpeg" >
				</audio>
			</div>
			<input onchange="load_file(this.files[0])" type="file" name="file" >
		</div>
		<div class="class_31" >
			<button class="class_32"  >
				Save
			</button>
			<button class="class_33"  >
				Cancel
			</button>
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

	function load_file(file)
	{
		document.querySelector('.js-file').src = URL.createObjectURL(file);
	}
</script>
