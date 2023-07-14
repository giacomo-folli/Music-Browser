<?php
	require 'init.php';
	$title = "Home";

	$user_id = user('id');
	$query = "SELECT * FROM songs ORDER BY id DESC LIMIT 30 ";
	$songs = query($query);

	if(!empty($songs)) 
	{
		foreach($songs as $key => $row)
		{
			$id = $row['user_id'];
			$query = "SELECT * FROM users WHERE id='$id' LIMIT 1";
			$artist = query($query);

			if(!empty($artist))
			{
				$songs[$key]['artist'] = $artist[0];
			}
		}
	}
?>

<?php require 'header.php';?>

<div class="class_13" >
	<h1 class="class_14"  >
		Music Website
	</h1>
</div>

<div class="class_15" >
	<?php if(!empty($songs)):?>
		<?php foreach($songs as $song):?>
			<a href="song.php?id=<?=$song['id']?>" class="class_16" >
				<img src="<?=get_image($song['image'])?>"  backup="" class="class_17 item_class_3">
				<h3 class="class_18"  >
					<?=esc($song['title'])?>
				</h3>
				<div class="class_19" >
					<i class="bi bi-person-fill class_20"></i>
					<div class="class_21"  >
						<?=$song['artist']['first_name'] ?? 'Unknown' ?> <?=$song['artist']['last_name'] ?? '' ?>
					</div>
				</div>
			</a>
		<?php endforeach;?>
	<?php endif;?>
</div>
 
<?php require 'footer.php';?>