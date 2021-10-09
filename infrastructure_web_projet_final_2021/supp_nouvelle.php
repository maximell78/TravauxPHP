<?php
    include_once 'include/config.php'; 

    if(!isset($_GET['id'])) { // Vérification que la page reçoit un identifiant en paramètre
        echo 'Identifiant manquant';
        exit();
    }

    if (isset($_POST['submit']) && isset($_GET['id'])) {
        $message = '';
        $mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
        if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue
            echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
        } 
        
        if ($requete = $mysqli->prepare("DELETE FROM nouvelles WHERE id=?")) {  // Création d'une requête préparée 
        
        $requete->bind_param("i", $_GET['id']); // Envoi des paramètres à la requête. 

        if($requete->execute()) { // Exécution de la requête
            $messageMAJ = "<div class='alert alert-success'>Produit supprimé</div>";  // Message ajouté dans la page en cas d'ajout réussi
        } else {
            $messageMAJ =  "<div class='alert alert-danger'>Une erreur est survenue lors de la suppression.</div>";  // Message ajouté dans la page en cas d'ajout en échec
        }

        $requete->close(); // Fermeture du traitement
        } else  {
        echo $mysqli->error;
        }
    
        $mysqli->close(); // Fermeture de la connexion 
    
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

        $requete->close(); // Fermeture du traitement 
    }

    $mysqli->close(); // Fermeture de la connexion 
    include_once 'include/header.php';
?>

<div class="containter pt-5 text-center">
    <div class="col-12 mr-3 mb-3">
        <div class="card h-100">          
            <h4 class="card-header"><?php echo $nouvelle["titre"]?></h4>
            <p class="card-body">Voulez-vous vraiment supprimer ce produit?</p>
            <form class="card-footer" method="POST">
                <button class="btn btn-danger" name="submit" type="submit">Oui</button>
                <a href="administration_nouvelles.php" class="btn btn-light">Non</a>
            </form>
            <br>
            <?php echo $messageMAJ ?>`<br>
        </div>        
    </div>
</div>
<div class="container-fluid text-center pb-5">
    <div class="row">
        <div class="col-6">
            <a href="index.php">Retour à la page d'accueil</a>                
        </div>
        <div class="col-6">
            <a href="administration_nouvelles.php">Retour à la page d'administration des nouvelles</a>
        </div>
    </div>
</div>

<?php
    include_once ('include/footer.php')
?>