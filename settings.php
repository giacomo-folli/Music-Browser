<?php

	require 'init.php';
	$title = "Settings";

	if(!is_logged_in())
	{
		redirect('login');
	}
?>

	<?php require 'header.php';?>

	<div class="class_51" >
		<h1 class="class_52"  >
			Artist Settings
			<br>
		</h1>
		<div class="class_53"  style="padding: 10px;">
			<div class="class_54" >
				<img src="assets/images/pexels-photo-3756774.jpeg" class="class_27" >
				<input type="file" name="image"  class="class_28">
			</div>
			<div class="class_24" >
				<label class="class_55"  >
					Username
				</label>
				<input placeholder="" type="text" name="username" class="class_12" >
			</div>
			<div class="class_24" >
				<label class="class_55"  >
					First Name
				</label>
				<input placeholder="" type="text" name="username" class="class_12" >
			</div>
			<div class="class_24" >
				<label class="class_55"  >
					Last Name
				</label>
				<input placeholder="" type="text" name="username" class="class_12" >
			</div>
			<div class="class_24" >
				<label class="class_55"  >
					Email
				</label>
				<input placeholder="" type="text" name="username" class="class_12" >
			</div>
			<div class="class_24" >
				<label class="class_55"  >
					Password
				</label>
				<input placeholder="" type="text" name="username" class="class_12" >
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
		</div>
	</div>
 
 
<?php require 'footer.php';?>