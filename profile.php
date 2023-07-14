<?php
	require 'init.php';
	$title = "Profile";

	if(!is_logged_in())
	{
		redirect('login');
	}

	$id = user('id');
	$query = "SELECT * FROM users WHERE id = '$id'";
	$row = query($query);

	if(!empty($row)) 
	{
		$row = $row[0];

		$user_id = user('id');
		$query = "SELECT * FROM songs WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 10 ";
		$songs = query($query);

		$query = "SELECT COUNT(*) AS total FROM songs WHERE user_id = '$user_id'";
		$total_songs = query($query);

		$total_songs = $total_songs[0]['total'];
	
	}

?>

	<?php require 'header.php';?>
 
	<div class="class_35" >
		<h1 class="class_14"  >
			Artist Profile
		</h1>

		<div style="color:red;padding:10px;text-align:center">
			<?php
				if(!empty(message())) {
					echo message("", true);
				} 
			?>
		</div>	

		<?php if(!empty($row)): ?>
			<div class="class_36" >
				<div class="class_37" >
					<img src="<?=get_image(user('image'))?>" class="class_38" >

					<h1 class="class_18" style="margin-bottom:0px;" >
						<?=$row['first_name']?> <?=$row['last_name']?>
					</h1>
					<div class="class_18" style="margin-bottom:10px;" >
						<h2><?=$row['username']?></h2> 
					</div>

					<div class="class_39" >
						<div class="class_40" >
							<i class="bi bi-vinyl-fill class_41">
							</i>
							<h3 class="class_42"  >
								<?=$total_songs?> Songs
							</h3>
						</div>
						<div class="class_40" >
							<i class="bi bi-bar-chart-line-fill class_41">
							</i>
							<h3 class="class_42"  >
								400 Plays
							</h3>
						</div>
						<div class="class_40" >
							<i class="bi bi-cloud-download-fill class_41">
							</i>
							<h3 class="class_42"  >
								400 Downloads
							</h3>
						</div>
					</div>
					<?php if(user('id') == $row['id']): ?>
						<a href="settings.php">
							<button class="class_32"  >
								Edit Profile
							</button>
						</a>
					<?php endif; ?>
				</div>
				<div class="class_43" >

					<?php if(!empty($songs)): ?>

						<?php foreach($songs as $song): ?>
							<div class="class_44" >
								<div class="class_45" >
									<img src="<?=get_image($song['image'])?>" class="class_46" >
								</div>
								<div class="class_47" >
									<h3 class="class_18"><?=esc($song['title'])?></h3>
									<div class="class_29" >
										<audio controls="" class="class_30" >
											<source src="<?=$song['file']?>" type="audio/mpeg" >
										</audio>
									</div>
								</div>
								<div class="class_48" >
									<button class="class_49"  >
										Edit
									</button>
									<button class="class_50"  >
										Delete
									</button>
								</div>				
							</div>
						<?php endforeach?>

					<?php else: ?>
						<div style="color:black; padding:10px; text-align:center;" >No songs found!
							<br><a href="upload.php">Upload a song</a>
						</div>
					<?php endif; ?>

				</div>
			</div>
		<?php endif; ?>
	</div>
<?php require 'footer.php';?>