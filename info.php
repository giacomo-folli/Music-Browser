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

<div style="height:300px;align-items:center;" class="class_13" >
</div>

<div style="background-color:#ffffff;color:#000000dd;max-width:500px;margin:auto;" class="class_15" >
	<p>- Introducing <strong>Melodious</strong> -<br>The ultimate song sharing music website! Our platform was lovingly crafted by a team of dedicated music enthusiasts who are truly passionate about the art of melodies. With a shared vision of fostering a vibrant community where music lovers can connect, collaborate, and celebrate their passion for tunes, the Melodious team poured their hearts into creating a seamless and user-friendly experience.<br><br> Whether you're an aspiring artist seeking to share your original creations or a devoted listener in search of new musical horizons, Melodious welcomes you to join our harmonious community and contribute to the world of music! Together, we can spread the joy of melodies and create a symphony of creativity.</p>
</div>
 
<?php require 'footer.php';?>