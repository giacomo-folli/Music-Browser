<?php

	require 'init.php';
	$title = "Upload";

	if(!is_logged_in())
		redirect('login');

	if(get_role() != '')
		redirect('index');

	$button_title = "Save";
	$mode = $_GET['mode'] ?? "new";
	$id = $_GET['id'] ?? 0;

	$id = (int) $id;
	$display = true;

	//acces edit/delete temp pages, changes the main page
	if($mode == 'edit' || $mode == 'delete')
	{
		if($mode == 'delete')
			$button_title = "Delete";

		$user_id = user('id');
		$query = "SELECT * FROM songs WHERE id = '$id' && user_id='$user_id' LIMIT 1"; //so you can only grab your own songs
		$song = query($query);
		if(!empty($song)) 
		{
			$song = $song[0];
		}
		else
		{
			$display = false;
		}
	}	

	if($_SERVER['REQUEST_METHOD'] == "POST") //Something was posted 
	{
		$errors = [];

		if(empty($_POST['title']))
			$errors['title'] = "Title is required";

		$folder = "uploads/";
		if(!file_exists($folder))
			mkdir($folder, 0777, true);

		$file_str = $album_id = $image_str = "";

		if(!empty($_FILES['file']['name']))
		{
			$allowed = ['audio/mpeg'];
			if(in_array($_FILES['file']['type'], $allowed))	{
				$file = $folder . $_FILES['file']['name'];
				$file_str = ", file = '$file' ";
			} 
			else {
				$errors['file'] = "Audio file not supported";
			}
		} else {
			if($mode == 'new')
				$errors['file'] = "Audio file is required";	
		}

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
				$errors['image'] = "Only png, jpeg and webp images are allowed";
			}	
		} else {
			if($mode == 'new')
				$errors['image'] = "Image is required";	
		}

		if(empty($errors)){
			//save data
			$user_id = user('id');

			if(!empty($image))
			{
			    if($mode == 'edit' && file_exists($song['image']))
					unlink($song['image']);
					
				move_uploaded_file($_FILES['image']['tmp_name'], $image);
			}	
			if(!empty($file))
			{
				if($mode == 'edit' && file_exists($song['file']))
					unlink($song['file']);
					
				move_uploaded_file($_FILES['file']['tmp_name'], $file);
			}	
			if($_POST['album_id'] != '')
				$album_id = ", album_id = '$album_id' ";

			$title = addslashes($_POST['title']);

			if($mode == 'edit')
			{
				$query = "UPDATE songs SET title = '$title' $album_id $image_str $file_str WHERE id = '$id' && user_id = '$user_id' LIMIT 1";
				message("Your song successfully edited!");
			}
		    else if($mode == 'delete')
			{
				$query = "DELETE FROM songs WHERE id = '$id' && user_id = '$user_id' LIMIT 1";
				message("Your song successfully deleted!");

				if(file_exists($song['image']))
					unlink($song['image']);

				if(file_exists($song['file']))
					unlink($song['file']);
			}
			else {
				$album_id = addslashes($_POST['album_id']);

			    $query = "INSERT INTO songs (user_id, file, image, title, album_id, date) VALUES ('$user_id', '$file', '$image', '$title', '$album_id', NOW())";
			    message("Your song successfully added!");
			}
			
			query($query);
			redirect("profile");
		}
	} 
?>

<?php require 'header.php';?>

<div class="class_22" >
	<form method="post" enctype="multipart/form-data" class="class_23" >
		<h1 class="class_18"  >
			<?php if($mode == 'edit'): ?>
				Edit Song
			<?php elseif($mode == 'delete'): ?>
				<span >Delete Song</span>
				<div style="color:red;font-size:18px">Are you sure you want to delete this song?</div>
			<?php else: ?>
				Upload Song
			<?php endif; ?>
		</h1>
		<div style="color:red;padding:10px;">
			<?php
				if(!empty($errors)) {
					echo implode("<br>", $errors);
				} 
			?>
		</div>
		<?php if($display): ?>
			<div class="class_24" >
				<label class="class_25"  >
					Title
				</label>
				<input value="<?=old_value('title', $song['title'] ?? '')?>" placeholder="" type="text" name="title" class="class_12" >
			</div>
			<div class="class_26" >
				<img src="<?=get_image($song['image'] ?? '')?>" class="js-image class_27" >
				<input onchange="display_image(this.files[0])" type="file" name="image"  class="class_28">
			</div>
			<div class="class_26" >
				<div class="class_29" >
					<audio controls="" class="js-file class_30" >
						<source src="<?=$song['file'] ?? ''?>" type="audio/mpeg" >
					</audio>
				</div>
				<input onchange="load_file(this.files[0])" type="file" name="file" >
			</div>

			<?php if($mode != 'delete'): ?>
				<div class="class_1211">
					<input type="checkbox" id="album_opt">
					<label for="html">Insert into album</label>
					<input value="<?=old_value('album_id', $song['album_id'] ?? '')?>" placeholder="Album id" type="text" name="album_id" class="class_1212 class_12">
				</div>
			<?php endif; ?>

			<div class="class_31" >
				<button class="class_32"  >
					<?=$button_title?>
				</button>
				<a href="profile.php">
					<button type="button" class="class_33"  >
						Cancel
					</button>
				</a>
				<div class="class_34" >
				</div>
			</div>
		<?php else: ?>
			<div style="color:red;font-size:18px">Song not found</div>
		<?php endif; ?>	
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
