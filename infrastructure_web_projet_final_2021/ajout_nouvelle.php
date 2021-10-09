<?php
        include_once 'include/config.php';    
        $messageAjout = "";

        // Vérification que la page a été soumise et que tous les champs sont présents

        if(isset($_POST["titre"]) && isset($_POST["description_courte"]) && isset($_POST["description_longue"]) && isset($_POST["date_nouvelle"]) && isset($_POST["actif"]) && isset($_POST["fk_categorie"])) {
            $mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données        
            if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue
                echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
            }

            //Création d'une requête préparée

            if ($requete = $mysqli->prepare("INSERT INTO nouvelles(titre, description_courte, description_longue, date_nouvelle, actif, fk_categorie) VALUES(?, ?, ?, ?, ?, ?)")) {
                $requete->bind_param("ssssii", $_POST["titre"], $_POST["description_courte"], $_POST["description_longue"], $_POST["date_nouvelle"], $_POST["actif"], $_POST["fk_categorie"]);

                if($requete->execute()){ // Exécution de la requête
                    $messageAjout = "<div class='alert alert-success'> Propriétaire ajouté </div>";
                } else {
                    $messageAjout = "<div class='alert alert-danger'> Une erreur c'est produite lors de l'ajout </div>";
                }
                $requete->close();
            } else {
                $mysqli->error;
            }
            $mysqli->close();
        }
        include_once 'include/header.php';
    ?>    

    <!-- Formulaire de MaJ -->

    <div class="text-center pt-4">
        <h1>Ajout d'une nouvelle</h1>
        <?php $messageAjout ?>    
    </div>
        <form class="needs-validation" novalidate method="POST">
            <div class="container pt-3">
                <div class="form-row">
                    <div class="col-12">
                        <div class="container">
                            <div class="row">                            
                                <div class="col-md-4 mb-3">
                                    <label for="titre">Titre *</label>                                
                                    <input type="text" class="form-control" id="titre" name="titre" placeholder="Votre titre" maxlength="50">
                                    <div class="invalid-feedback">
                                        Le titre est requis et doit comporter moins de 50 caractères. 
                                    </div>
                                    <label for="description_courte">Description de la nouvelle (Courte) *</label>                        
                                    <textarea class="form-control" rows="8" id="description_courte" name="description_courte" required max="125" placeholder="Votre description courte"></textarea>
                                    <div class="invalid-feedback">
                                        La description courte est requis et doit comporter moins de 125 caractères. 
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="date_nouvelle">Date de la nouvelle *</label>                        
                                    <input type="date" class="form-control" id="date_nouvelle" name="date_nouvelle" required min="2021-01-01" max="<?php setlocale(LC_TIME,"fr_FR.UTF-8","fra");?>">
                                    <div class="invalid-feedback">
                                        La date est invalide 
                                    </div>
                                    <label for="prix_vente">Description de la nouvelle (Longue) *</label>
                                    <textarea rows="8" class="form-control" id="description_longue" name="description_longue" placeholder="Votre description longue" maxlength="1000" required></textarea>
                                    <div class="invalid-feedback">
                                        La description courte est requis et ne comporte aucun maximum de caractère. 
                                    </div>
                                </div>                            
                                <div class="col-md-4 mb-3">                     
                                    <label for="fk_categorie">La catégorie de la nouvelle *</label>                                
                                    <textarea class="form-control" rows="4" id="fk_categorie" name="fk_categorie" placeholder="1 pour Général &#10;2 pour Consignes&#10;3 pour Lorem ipsum"></textarea>
                                    <div class="invalid-feedback">
                                        Catégorie non existante
                                    </div>
                                    <label for="fk_categorie">Nouvelle active *</label>                                                    
                                    <textarea class="form-control" id="actif" name="actif" placeholder="0 pour non-active &#10; 1 pour active"></textarea>
                                    <div class="invalid-feedback">
                                        La description courte est requis et doit comporter moins de 125 caractères. 
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="container pt-5">
                            <div class="row">
                                <div class="offset-1 col-4">
                                    <button class="offset-4 btn btn-primary" type="submit">Ajout de la nouvelle</button>
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