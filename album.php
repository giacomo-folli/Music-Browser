<?php
	require 'init.php';
	$title = "Album";

	$album_id = $_GET['id'] ?? 0;
    $album_id = (int) $album_id;

    $query = "SELECT * FROM album WHERE id = '$album_id' LIMIT 1";
    $albums = query($query);

    if(!empty($albums))
    {
        $album = $albums[0];
    }

	$query = "SELECT * FROM songs WHERE album_id = '$album_id'";
	$songs = query($query);
?>

<?php require 'header.php';?>

<div style="background:#ddd;padding:10px 0 20px 0;display: flex;justify-content: center; align-items: center;flex-direction: column;">
    <?php if(!empty($album)): ?>
        <h1 style="color:#100; font-size:26px;margin:0">
            Album: <?=$album['title']?>
        </h1>
        <img src="<?=get_image($album['image'])?>" class="class_38" style="min-width:20em; height:auto;">

        <?php if(!empty($songs)): ?>
            <?php foreach($songs as $song): ?>

                <div style="margin:5px 0 0 0;background:#aaaaaa22; min-width:20em;">
                    <a style="color:#100;text-decoration:none;padding:5px;border-radius:10px;" href="song.php?id=<?=$song['id']?>">
                        <?=$song['title']?>
                    </a>
                </div>

            <?php endforeach; ?>

        <?php else: ?>
            <div style="color:red;font-size:18px">Album contains no songs!</div>
        <?php endif; ?>

    <?php else:?>
        <div style="color:red;font-size:18px">Album not found!</div>
    <?php endif; ?>
</div>

<?php require 'footer.php';?>