<?php
    include_once 'include/config.php'; 
    
    // SECTION POUR LA MISE À JOUR
    $messageMAJ = '';

    // Vérification que la page a été soumise et que tous les champs sont présents
    if(isset($_POST['id']) && isset($_POST['titre']) && isset($_POST['description_courte']) && isset($_POST['description_longue']) && isset($_POST['date_nouvelle']) && isset($_POST['actif']) && isset($_POST['categorie'])) { 
    $mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
    if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue
        echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
    } 
    
    if ($requete = $mysqli->prepare("UPDATE nouvelles SET titre=?, description_courte=?, description_longue=?, date_nouvelle=?, actif=?, fk_categorie=? WHERE id=?")) {  // Création d'une requête préparée 
        
        $requete->bind_param("ssssiii", $_POST['titre'], $_POST['description_courte'], $_POST['description_longue'], $_POST['date_nouvelle'], $_POST['actif'], $_POST['fk_categorie'], $_POST['id']); // Envoi des paramètres à la requête. 

        if($requete->execute()) { // Exécution de la requête
        $messageMAJ = "<div class='alert alert-success'>Nouvelle mis à jour</div>";  // Message ajouté dans la page en cas d'ajout réussi
        } else {
        $messageMAJ =  "<div class='alert alert-danger'>Une erreur est survenue lors de la mise à jour.</div>";  // Message ajouté dans la page en cas d'ajout en échec
        }

        $requete->close(); // Fermeture du traitement
    } else  {
        echo $mysqli->error;
    }

    $mysqli->close(); // Fermeture de la connexion 

    }

    // SECTION POUR L'AFFICHAGE
    if(!isset($_GET['id'])) { // Vérification que la page reçoit un identifiant en paramètre
    echo 'Identifiant manquant';
    exit();
    }

    $mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
    if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue
        echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
        exit();
    } 

    if ($requete = $mysqli->prepare("SELECT * FROM nouvelles WHERE nouvelles.id=?")) {  // Création d'une requête préparée 

    $requete->bind_param("s", $_GET['id']); // Envoi des paramètres à la requête
    $requete->execute(); // Exécution de la requête

    $result = $requete->get_result(); // Récupération de résultats de la requête
    $nouvelle = $result->fetch_assoc(); // Récupération de l'enregistrement
    
    $requete->close(); // Fermeture du traitement 
    }

    $mysqli->close(); // Fermeture de la connexion
    include_once 'include/header.php';
?>

<!-- Formulaire de MaJ -->
<?php 
        $mysqli = new mysqli($host, $username, $password, $db);
        if ($mysqli -> connect_errno) {
            echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error;
            exit();
        } else  {
            $res = $mysqli->query("SELECT * FROM nouvelles WHERE nouvelles.id=?");
    ?>
<div class="text-center pt-4">
    <h1>Mise à jour de la nouvelle "<?= $nouvelle["titre"] ?>"</h1>
</div>
    <?php echo $messageMAJ ?>
    <form class="needs-validation" novalidate method="POST">
        <div class="container pt-3">
            <div class="form-row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">                            
                            <div class="col-md-4 mb-3">
                                <label for="titre">Titre *</label>        
                                <input type="hidden" id="id" name="id" value="<?= $nouvelle["id"] ?>">
                                <input type="text" class="form-control" id="titre" name="titre" value="<?= $nouvelle["titre"] ?>" required maxlength="50">
                                <div class="invalid-feedback">
                                    Le titre est requis et doit comporter moins de 50 caractères. 
                                </div>
                                <label for="description_courte">Description de la nouvelle (Courte) *</label>                        
                                <textarea class="form-control" rows="8" id="description_courte" name="description_courte" required max="125"><?= $nouvelle["description_courte"] ?></textarea>
                                <div class="invalid-feedback">
                                    La description courte est requis et doit comporter moins de 125 caractères. 
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="date_nouvelle">Date de la nouvelle *</label>                        
                                <input type="date" class="form-control" id="date_nouvelle" name="date_nouvelle" value="<?= $nouvelle["date_nouvelle"] ?>" required min="2021-01-01" max="<?php setlocale(LC_TIME,"fr_FR.UTF-8","fra");?>">
                                <div class="invalid-feedback">
                                    La date est invalide 
                                </div>
                                <label for="prix_vente">Description de la nouvelle (Longue) *</label>
                                <textarea rows="8" class="form-control" id="description_longue" name="description_longue" required><?= $nouvelle["description_longue"] ?></textarea>
                                <div class="invalid-feedback">
                                    La description courte est requis et ne comporte aucun maximum de caractère. 
                                </div>
                            </div>                            
                            <div class="col-md-4 mb-3">                     
                                <label for="fk_categorie">La catégorie de la nouvelle *</label>                                
                                <input type="text" class="form-control" id="fk_categorie" name="fk_categorie" value="<?= $nouvelle["fk_categorie"]?>"></input>
                                <div class="invalid-feedback">
                                    La catégorie choisit est invalide 
                                </div>
                                <label for="fk_categorie">Nouvelle active *</label>                    
                                <input type="text" class="form-control" id="fk_categorie" name="fk_categorie" value="<?= $nouvelle["actif"]?>"></input>
                                <div class="invalid-feedback">
                                    Le choix est invalide 
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="container pt-5">
                        <div class="row">
                            <div class="offset-1 col-4">
                                <button class="offset-4 btn btn-primary" type="submit" name="majSubmit">Modifier la nouvelle</button>
                            </div>
                            <div class="col-4">
                                <a href="administration_nouvelles.php" class="offset-4 btn btn-danger">Annuler</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php
    }
    include_once 'include/footer.php';
?>
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