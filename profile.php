<?php

	require 'init.php'; 
	$title = "Profile"; 

	if(!is_logged_in()) 				// Verifica se l'utente è autenticato
		redirect('login'); 

	$id = $_GET['id'] ?? user('id'); 	// Ottieni ID utente dalla query string o utilizza l'ID dell'utente autenticato corrente
	$id = (int)$id; 					// Safety control
	
	$query = "select * from users where id = '$id' limit 1"; 	
 	$row = query($query);

 	if(!empty($row)) {
		$row = $row[0]; 
		
		// Query per ottenere le canzoni caricate dall'utente
		$user_id = $row['id']; 			
		$query = "select * from songs where user_id = '$user_id' order by id desc limit 10"; 
	 	$songs = query($query); 

		// Query per ottenere il numero totale di canzoni caricate dall'utente
	 	$query = "select count(*) as total from songs where user_id = '$user_id' "; 
	 	$total_songs = query($query);
	 	$total_songs = $total_songs[0]['total'];

		// Query per ottenere il numero totale di visualizzazioni delle canzoni dell'utente
	 	$query = "select sum(views) as total from songs where user_id = '$user_id' "; 
	 	$total_views = query($query);
	 	$total_views = $total_views[0]['total']; 
		
		// Query per ottenere il numero totale di download delle canzoni dell'utente
	 	$query = "select sum(downloads) as total from songs where user_id = '$user_id' "; 
	 	$total_downloads = query($query);
	 	$total_downloads = $total_downloads[0]['total'];
	}
?>

	<?php require 'header.php';?> 			<!-- Includi l'intestazione della pagina -->

	<div class="class_35" >
		<h1 class="class_14"  >
			Artist Profile
		</h1>
		<div style="color: red;padding: 10px;text-align: center;">
			<?php
				if(!empty(message())){ 		// Verifica se ci sono messaggi 
					echo message('',true); 	// Visualizza il messaggio
				}
			?>
		</div>

		<!-- Verifica dettagli dell'artista disponibili -->
		<?php if(!empty($row)):?> 			
			<div class="class_36" >
				<div class="class_37" >
					<!-- Mostra l'immagine dell'artista -->
					<img src="<?=get_image($row['image'])?>" class="class_38" > 
					<h1 class="class_18" style="margin-bottom:0px"  >
						<?=$row['first_name']?> <?=$row['last_name']?> 
					</h1>
					<div class="class_18" style="margin-bottom: 10px;" >
						<?=$row['username']?> 
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
								<?=$total_views?> Plays 
							</h3>
						</div>
						<div class="class_40" >
							<i class="bi bi-cloud-download-fill class_41">
							</i>
							<h3 class="class_42"  >
								<?=$total_downloads?> Downloads
							</h3>
						</div>
					</div>

					<!-- Verifica se l'utente attuale è il proprietario del profilo -->
					<?php if(user('id') == $row['id']):?> 
						<a href="settings.php">
							<button class="class_32"  >
								Edit Profile
							</button>
						</a>
					<?php endif;?>

				</div>
				<div class="class_43" >

					<!-- Verifica se ci sono canzoni caricate dall'artista -->
					<?php if(!empty($songs)):?> 

						<?php foreach($songs as $song):?> 
							<div class="class_44" >
								<div class="class_45" >
									<img src="<?=get_image($song['image'])?>" class="class_46" > 
								</div>
								<div class="class_47" >
									<h3 class="class_18"  >
										<?=esc($song['title'])?> 
									</h3>
									<div class="class_29" >
										<audio controls="" class="class_30" >
											 <!-- Lettore audio per la canzone -->
											<source src="<?=$song['file']?>" type="audio/mpeg" >
										</audio>
									</div>
								</div>

								 <!-- Verifica se l'utente attuale è il proprietario del profilo -->
								<?php if(user('id') == $row['id']):?>
									<div class="class_48" >
										<a href="upload.php?mode=edit&id=<?=$song['id']?>">
											<button class="class_49"  >
												Edit
											</button>
										</a>
										<a href="upload.php?mode=delete&id=<?=$song['id']?>">
											<button class="class_50"  >
												Delete
											</button>
										</a>
									</div>
								<?php endif;?>

							</div>
						<?php endforeach?>
							
					<?php else:?>
						<div style="color:black;padding:10px;text-align: center;">No songs found!<br><a href="upload.php">Upload a song</a></div>
					<?php endif;?>

					</div>
				</div>
			<?php endif;?>
		</div>
						 
<?php require 'footer.php';?> 		<!-- Includi il piè di pagina -->