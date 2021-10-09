<?php
// Vérification que l'action d'ajout a été soumise et que tous les champs sont présents
  if(isset($_POST['ajoutSubmit']) && isset($_POST['code']) && isset($_POST['nom']) && isset($_POST['prix_unitaire']) && isset($_POST['prix_vente']) && isset($_POST['qte_stock'])) { 
    $mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
    if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue
      echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
    } 
    
    if ($requete = $mysqli->prepare("INSERT INTO produits(code, produit, prix_unitaire, prix_vente, qte_stock) VALUES(?, ?, ?, ?, ?)")) {  // Création d'une requête préparée 
      /************************* ATTENTION **************************/
      /* On ne fait présentement peu de validation des données.     */
      /* On revient sur cette partie dans les prochaines semaines!! */
      /**************************************************************/
      $requete->bind_param("ssddi", $_POST['code'], $_POST['nom'], $_POST['prix_unitaire'], $_POST['prix_vente'], $_POST['qte_stock']); // Envoi des paramètres à la requête. 

      if($requete->execute()) { // Exécution de la requête
        $messageAjout = "<div class='alert alert-success text-center'>Produit ajouté!</div>";  // Message ajouté dans la page en cas d'ajout réussi
      } else {
        $messageAjout =  "<div class='alert alert-danger text-center'>Une erreur est survenue lors de l'ajout.</div>";  // Message ajouté dans la page en cas d'ajout en échec
      }

      $requete->close(); // Fermeture du traitement
    } else  {
      echo $mysqli->error;
    }

    $mysqli->close(); // Fermeture de la connexion 
  } 
?>