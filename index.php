<?php
	require 'init.php';
	$title = "Home";

	$query = "SELECT * FROM songs ORDER BY id DESC LIMIT 10";
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

<?php if(!is_logged_in()): ?>
	<div id="preloader"></div>	
<?php endif; ?>

<form style="background-color:#000000dd;" method="get" action="search.php" class="class_10_index" >
	<label class="class_11"  >
		Search
	</label>
	<input value="<?=$_GET['q'] ?? ''?>" placeholder="" type="text" name="q" class="class_12" >
</form>

<div class="class_13 fix_me" >
	<h1 class="class_14_index" >
		melodiouss | share your melodies
	</h1>
</div>

<div class="class_15">
	<?php if(!empty($songs)):?>
		<?php foreach($songs as $song):?>
			<a href="song.php?id=<?=$song['id']?>" class="class_16" id="song_card" >
				<img src="<?=get_image($song['image'])?>"  backup="" class="class_17 item_class_3">

				<div class="credits">
				
					<div class="class_19 class_name">
						<i class="bi bi-music-note-beamed class_20"></i>
						<div class="class_18" >
							<strong><?=esc($song['title'])?></strong>
						</div>
					</div>

					<div class="class_19">
						<i class="bi bi-person-fill class_20"></i>
						<div class="class_21"  >
							<?=$song['artist']['username'] ?? 'Unknown' ?>
						</div>
					</div>

				</div>

			</a>
		<?php endforeach;?>
	<?php endif;?>
</div>

<?php if(!is_logged_in()): ?>
	<script>
		var loader = document.getElementById("preloader");
		window.addEventListener("load", () => {
		setTimeout(() => {
			loader.style.display = "none";
		}, 3000);
		});
	</script>
<?php endif; ?>

 
<?php require 'footer.php';?> 
