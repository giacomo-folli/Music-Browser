<?php

	require 'init.php'; 
	$title = "User profile"; 

	$id = $_GET['id'] ?? user('id'); 	// Ottieni ID utente dalla query string o utilizza l'ID dell'utente autenticato corrente
	$id = (int)$id; 					// Safety control
	
	$query = "select * from users where id = '$id' limit 1"; 	
 	$row = query($query);

    if(!empty($row)) 
	    $row = $row[0]; 
?>

	<?php require 'header.php';?> 			<!-- Includi l'intestazione della pagina -->

	<div class="class_35" >
		<h1 class="class_14"  >
			User profile
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
				
                    <a href="settings.php">
                        <button class="class_32"  >
                            Edit Profile
                        </button>
                    </a>
                    
				</div>
				<div class="class_43" >

					<!-- Verifica se ci sono canzoni caricate dall'artista -->

				</div>
			<?php endif;?>
		</div>
						 
<?php require 'footer.php';?> 		<!-- Includi il piè di pagina -->