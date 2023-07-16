<?php

	require 'init.php';
	$title = "Artists";

	$query = "SELECT * FROM users WHERE role = 'music' ORDER BY id DESC LIMIT 30";
 	$users = query($query);
?>

<?php require 'header.php';?>

<h1 class="class_14"  >
    Artist Profiles
</h1>

<div class="class_1515" >
    <?php if(!empty($users)):?>
        <?php foreach($users as $user):?>
            <a href="profile.php?id=<?=$user['id']?>" class="class_1616" >
                <img src="<?=get_image($user['image'])?>" backup="" class="class_17 class_1717">
                <h3 class="class_18"  >
                    <?=$user['username']?> 
                </h3>
            </a>
        <?php endforeach;?>
    <?php else:?>
        <div style="text-align: center;padding: 10px;">No artists found</div>
    <?php endif;?>
</div>

<?php require 'footer.php';?>