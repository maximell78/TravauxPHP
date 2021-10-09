<?php 
	include_once('include/header.php');	
?>

<!-- Page Content -->
<div class="container">

	<h1 class="my-4 text-center">Administration - Nouvelles</h1>
	<a href="ajout_nouvelle.php" class="btn btn-primary">Ajout de la nouvelle</a>
	
	<!-- Cette section doit permettre de gérer (lister, ajouter, modifier et supprimer) des nouvelles. -->
	<!-- Vous pouvez réaliser cette demande en utilisant plusieurs pages php (une pour l'ajout, une pour l'édition et une pour la suppression) ou utiliser des composants Modals -->
	<!-- Il doit être impossible d'accéder à cette page sans être préalablement connecté. Si un utilisateur non connecté essaie d'accéder à la page, un message d'erreur doit s'afficher -->
	
</div>

<?php
	$mysqli = new mysqli($host, $username, $password, $database);
	if ($mysql -> connect_errno) {
		echo "Échec de connexion à la base de donnée MySQL: " . $mysqli -> connect_error;
		exit();
	} else {
		$res = $mysqli -> query("SELECT * FROM nouvelles ORDER BY date_nouvelle DESC");
	}
?>
<div class="container">
	<div class="row">
		<?php
		while ($row = $res -> fetch_assoc()){
		?>
		<div class="col-12 card pt-3 pb-3 mt-4">                
			<h4><?php echo $row["titre"]?></h4>          
			<h6 class="card-title"><?php echo $row["date_nouvelle"]?></h6>
			<p><?php echo $row["description_longue"]?></p>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 text-center">
						<tr>
							<td class="text-center">
								<!-- bouton afficher -->
								<a href="nouvelle.php?id=<?php echo $row["id"]?>" class="btn btn-default" aria-label="Afficher le produit">
									<svg class="bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>';
										<path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
									</svg>
								</a>

								<!-- bouton modifier -->
								<a href="maj_nouvelle.php?id=<?php echo $row["id"]?>" class="btn btn-default" aria-label="Modifier le produit">
									<svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
										<path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
									</svg>
								</a>
								
								<!-- bouton supprimer -->
								<a href="supp_nouvelle.php?id=<?php echo $row["id"]?>" class="btn btn-default" aria-label="Supprimer le produit">
									<svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
										<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
									</svg>
								</a>
								
							</td>
						</tr>
					</div>
				</div>			        
			</div>
		</div>
		<?php
		}
		?>
	</div>		
</div>

<?php include_once('include/footer.php'); 
$requete->close(); // Fermeture du traitement 

$mysqli->close(); // Fermeture de la connexion
?>