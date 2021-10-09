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

    if ($requete = $mysqli->prepare("SELECT * FROM nouvelles WHERE id=?")) {  // Création d'une requête préparée 

      $requete->bind_param("s", $_GET['id']); // Envoi des paramètres à la requête
      $requete->execute(); // Exécution de la requête

      $result = $requete->get_result(); // Récupération de résultats de la requête
      $nouvelle = $result->fetch_assoc(); // Récupération de l'enregistrement 

    include_once('include/header.php');
    $res = $mysqli->query("SELECT * FROM nouvelles");  
?>
<div class="containter pt-5">
    <div class="col-12 mr-3 mb-3">
        <div class="card h-100">          
            <h4 class="card-header text-center"><?php echo $nouvelle["titre"]?></h4>
            <div class="card-body">
                <h6 class="card-title text-center"><?php echo $nouvelle["date_nouvelle"]?></h6>
                <p class="card-text text-center"><?php echo $nouvelle["description_longue"]?></p>
            </div>            
        </div>
    </div>
</div>
<div class="container-fluid text-center pb-5">
    <div class="row">
        <div class="col-6">
            <a href="index.php">Retour à la page d'accueil</a>                
        </div>
        <div class="col-6">
            <a href="nouvelles.php">Voir toutes les nouvelles</a>
        </div>
    </div>
</div>

<?php
    $requete->close(); // Fermeture du traitement 
                
    $mysqli->close(); // Fermeture de la connexion
    include_once ('include/footer.php')
?>