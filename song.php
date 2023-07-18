<?php
	require 'init.php';
	$title = "Song";

	$song_id = $_GET['id'] ?? 0;
    $song_id = (int) $song_id;

	$query = "SELECT * FROM songs WHERE id = '$song_id' LIMIT 1";
	$song = query($query);

	if(!empty($song)) 
	{
		$song = $song[0];

		$id = $song['user_id'];
        $query = "SELECT * FROM users WHERE id = '$id' LIMIT 1";
        $row = query($query);

        if(!empty($row)) 
        {
            $row = $row[0];
        }	

		if(user('id') != $song['user_id'])
			add_page_view($song['id']); //add a view to song

		$album_titles = query("SELECT album.title FROM album JOIN songs ON album.id=songs.album_id WHERE songs.id = $song_id;");

		if (!empty($album_titles))
			$album_title = $album_titles[0]['title'];

		//add_song_download($song['id']);
	}
?>

	<?php require 'header.php';?>
 
	<div class="class_35" >
		<?php if(!empty($row)): ?>
			<h1 class="class_14"  >	
				Now Playing:  
				<a style="text-decoration:none;" href="profile.php?id=<?=$row['id']?>">	
					<?=$row['username']?> 
				</a>
				<?php if(!empty($album_titles)): ?>
					| from <a href="album.php?id=<?=$song['album_id']?>"> 	
						<?=$album_title?>
					</a>
				<?php endif; ?>
			</h1>
		<?php endif; ?>


		<?php if(!empty($row)): ?>
			<div class="class_36">
				<div class="class_37" style="margin:auto;display:flex">
					
                    <img src="<?=get_image($song['image'])?>" class="class_38" style="max-width:400px; height:auto;flex:0.5">

					<div class="class_39" style="display:block;flex:2" >
						
						<?php if(!empty($song)): ?>
							<div class="class_44" >
								<div class="class_45" >
									<img src="<?=get_image($row['image'])?>" class="class_46">
								</div>
								<div class="class_47" >
									<h3 class="class_18"><?=esc($song['title'])?></h3>
									<div class="class_29" >
										<audio controls="" class="class_30" >
											<source src="<?=$song['file']?>" type="audio/mpeg" >
										</audio>
									</div>
								</div>	
							</div>
								
							<div style="color:black;text-align:center;">Page Views: <?=$song['views']?></div>
							<div style="color:black;text-align:center;">Downloads: <?=$song['downloads']?></div>

						<?php else: ?>
							<div style="color:black; padding:10px; text-align:center;" >No song found!
								<br><a href="upload.php">Upload a song</a>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php require 'footer.php';?>