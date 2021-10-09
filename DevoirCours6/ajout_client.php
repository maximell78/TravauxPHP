<!-- ajout_client.php -->
<!-- Programmé par : Maxime Lacroix-Lemire -->
<!-- Dernière Mise À  Jour :  2021/05/24 -->

<?php
    include_once "include/config.php";

    $messageAjout = "";

    // Vérification que la page a été soumise et que tous les champs sont présents

    if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["num_telephone"]) && isset($_POST["adresse"]) && isset($_POST["code_postal"]) && isset($_POST["ville"])) {
        $mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
        
        if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue

            echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;

        }

        //Création d'une requête préparée

        if ($requete = $mysqli->prepare("INSERT INTO proprietaire(nom, prenom, num_telephone, adresse, code_postal, ville) VALUES(?, ?, ?, ?, ?, ?)")) {
            $requete->bind_param("ssssss", $_POST["nom"], $_POST["prenom"], $_POST["num_telephone"], $_POST["adresse"], $_POST["code_postal"], $_POST["ville"]);

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
?>
<?php
        include_once "include/header.php";
    ?>
>
<body>
    <!-- Formulaire -->

    <section class="pb-5">
        <div class="container-fluid pt-5">
            <div class="row">
                <div class="offset-2 col-8 card bleu">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pt-4 text-center">Ajout d'un propriétaire</h2>
                                <?php $messageAjout ?>                                
                            </div>
                        </div>
                    </div>
                    <form method="post">                        
                        <div class="container-fluid pt-5 form-group">
                            <div class="row">
                                <div class="col-3 mr-3">
                                    <p>
                                        <strong>
                                            Identification
                                            <span class="rouge">*</span>
                                        </strong>
                                    </p>
                                </div>
                                <div class="pr-2">
                                    <input type="text" name="nom" id="nom" placeholder="Price" pattern="[A-Za-z]{}" minlength="2" maxlength="25" required></br>
                                    <label for="nom">Nom</label>
                                </div>
                                <div>
                                    <input type="text" name="prenom" id="prenom" placeholder="Carey" pattern="[A-Za-z]{}" minlength="2" maxlength="25" required></br>
                                    <label for="prenom">Prénom</label>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid pt-4 form-group">
                            <div class="row">
                                <div class="col-3 mr-3">
                                    <p>
                                        <strong>
                                            Numéro de téléphone
                                            <span class="rouge">*</span>
                                        </strong>
                                    </p>
                                </div>                                
                                <div>
                                    <input type="tel" name="num_telephone" id="num_telephone" maxlength="12" placeholder="819-555-1213" patterm="[0-9]{3,3}[\-][0-9]{3,3}[\-][0-9]{4,4}" required></br>
                                    <label for="num_telephone" class="pl-1">Numéro de téléphone</label>
                                </div>
                            </div>
                        </div>                        
                        <div class="container-fluid pt-4 form-group">
                            <div class="row">
                                <div class="col-3 mr-3">
                                    <p>
                                        <strong>
                                            Adresse
                                            <span class="rouge">*</span>
                                        </strong>
                                    </p>
                                </div>
                                <div>
                                    <input type="text" name="adresse" id="adresse" size="50" placeholder="123 Rue Stanley" pattern="[A-Za-z0-9]{}" minlength="2" maxlength="50" required></br>
                                    <label for="adresse"> Adresse</label>                               
                                </div>                            
                            </div>
                        </div>                        
                        <div class="container-fluid pt-2 form-group">
                            <div class="row">
                                <div class="col-3 mr-3">
                                </div>
                                <div>
                                    <input type="text" name="ville" id="ville" size="21" class="mr-2" placeholder="Montréal" pattern="[A-Za-z]{}" minlength="2" maxlength="25" required></br>
                                    <label for="ville"> Ville</label>                               
                                </div>
                                <div>
                                    <input type="text" name="code_postal" id="code_postal" size="21" class="mr-2" placeholder="J0J-1G1" pattern="[a-zA-Z]{1,1}[0-9]{1,1}[a-zA-Z]{1,1}[\-]{1,1}[0-9]{1,1}[a-zA-Z]{1,1}[0-9]{1,1}" minlength="7" maxlength="7" required></br>
                                    <label for="code_postal"> Code postal</label>                               
                                </div>
                            </div>
                        </div>                                                
                        <div class="container-fluid pb-5 pt-3 form-group">
                            <div class="row">
                                <div class="col-3 mr-3">                                
                                </div>
                                <div class="pt-5">
                                    <button class="btn btn-primary" type="submit">Ajout du client</button>                              
                                </div>                                                            
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </section>
    

<?php
    include_once "include/footer.php"
?>