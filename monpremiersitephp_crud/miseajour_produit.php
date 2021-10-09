<?php
    include_once 'include/config.php'; 

    if(!isset($_GET['id'])) { // Vérification que la page reçoit un identifiant en paramètre
      echo 'Identifiant manquant';
      exit();
    }

    $mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
    if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue
        echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
        exit();
    } 

    if ($requete = $mysqli->prepare("SELECT * FROM produits WHERE id=?")) {  // Création d'une requête préparée 

      $requete->bind_param("s", $_GET['id']); // Envoi des paramètres à la requête
      $requete->execute(); // Exécution de la requête

      $result = $requete->get_result(); // Récupération de résultats de la requête
      $produit = $result->fetch_assoc(); // Récupération de l'enregistrement
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Mise à jour d'un produit</title>
  </head>
  <body>
	<div class="container mt-3">
		<h1>Mise à jour du produit (?)</h1>
		<form class="needs-validation" novalidate>
		  <div class="form-row">
			<div class="col-md-4 mb-3">
              <label for="code">Code *</label>
              <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
			  <input type="text" class="form-control" id="code" name="code" required maxlength="25">
			  <div class="invalid-feedback">
				Le code est requis et doit comporter moins de 25 caractères. 
			  </div>
			</div>
			<div class="col-md-8 mb-3">
              <label for="nom">Nom du produit *</label>
              <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
			  <input type="text" class="form-control" id="nom" name="nom" required minlength="2" maxlength="50">
			  <div class="invalid-feedback">
				Le nom du produit est requis et doit comporter entre 2 et 50 caractères. 
			  </div>
			</div>
		  </div>
		  <div class="form-row">
			<div class="col-md-4 mb-3">
              <label for="prix_unitaire">Prix unitaire (coûtant) *</label>
              <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
			  <input type="number" step=".01" class="form-control" id="prix_unitaire" name="prix_unitaire" required>
			  <div class="invalid-feedback">
				Le prix coûtant est requis et doit être numérique. 
			  </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="prix_vente">Prix de vente *</label>
              <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
			  <input type="number" step=".01" class="form-control" id="prix_vente" name="prix_vente" required>
			  <div class="invalid-feedback">
				Le prix de vente est requis et doit être numérique. 
			  </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="qte_stock">Quantité en stock</label>
              <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
			  <input type="number" class="form-control" id="qte_stock" name="qte_stock" required>
			  <div class="invalid-feedback">
				La quantité en stock est requise et doit être numérique. 
			  </div>
			</div>
		  </div>

          <button class="btn btn-primary" type="submit">Modifier le produit</button>
          <a href="produits.php" class="float-right">Retour à la liste des produits</a>
		</form>
	</div>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>