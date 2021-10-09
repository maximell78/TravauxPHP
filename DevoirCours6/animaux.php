<!-- animaux.php -->
<!-- Programmé par : Maxime Lacroix-Lemire -->
<!-- Dernière Mise À  Jour :  2021/05/17 -->

<?php
    include_once "include/config.php";
    $mysqli = new mysqli($host, $username, $password, $database);

?>  
<?php
    include_once "include/header.php"
?>
    
    <?php 
        $mysqli = new mysqli($host, $username, $password, $database);
        if ($mysqli -> connect_errno) {
            echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error;
            exit();
        } else  {
            $res = $mysqli->query("SELECT animal.nom AS animal_nom, type_animal.type_animal, proprietaire.nom, proprietaire.prenom, proprietaire.num_telephone FROM animal INNER JOIN type_animal ON type_animal.id = fk_type_animal INNER JOIN proprietaire ON proprietaire.id = fk_proprietaire");
    ?>
        <table class="table">
            <tr>
                <th>Nom de l'animal</th>
                <th>Type de l'animal</th>
                <th>Nom du propriétaire</th>
                <th>Prenom du propriétaire</th>
                <th>Numéro de téléphone</th>
            </tr>
    
        <?php
            while ($row = $res->fetch_assoc()) {
    ?>
            <tr>
                <td><?php echo $row["animal_nom"]?></td>
                <td><?php echo $row["type_animal"]?></td>
                <td><?php echo $row["nom"]?></td>
                <td><?php echo $row["prenom"]?></td>
                <td><?php echo $row["num_telephone"]?></td>

            </tr>
        
    <?php
            }
    ?>
        </table>
    <?php        
        }
    ?>

    <?php
        if ($requete = $mysqli->prepare("INSERT INTO animal(nom,  fk_type_animal , ddn, fk_proprietaire) VALUES(?, ?, ?, ?)")) {
            $requete->bind_param("ssis", $_POST["nom"], $_POST["fk_type_animal"],  $_POST["ddn"], $_POST["fk_proprietaire"]);
                if($requete->execute()){ // Exécution de la requête
                    $messageAjout = "<div class='alert alert-success'> Propriétaire ajouté </div>";
                } else {
                    $messageAjout = "<div class='alert alert-danger'> Une erreur c'est produite lors de l'ajout </div>";
                }
            $requete->close();
        } else {
            $mysqli->error;
        }
    ?>

    <!-- Appel du modal -->

    <div class="text-center">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#monModal">Ajout d'un animal</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="monModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajout d'un animal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid pt-5">
                <div class="row">
                    <div class="offset-2 col-8 card bleu">                    
                        <form method="post">
                            <div class="container-fluid pt-5 form-group">
                                <div class="row">
                                    <div class="pr-2">                                    
                                        <input type="text" name="animal.nom" id="animal.nom" pattern="[A-Za-z]{}" minlength="2" maxlength="250" required></br>
                                        <label for="animal.nom">Nom de l'animal</label>
                                    </div>                                
                                </div>
                            </div>
                            <div class="container-fluid pt-4 form-group">
                                <div class="row">                                                                
                                    <div class="pr-2">
                                    <?php
                                    $res = $mysqli->query("SELECT id, type_animal FROM type_animal ORDER BY type_animal");
                                    echo '<select class="form-control" name="type_animal" id="type_animal">';
                                    echo '<option value="-1">Sélectionnez type d\'animal</option>';
                                    while ($row = $res->fetch_assoc()) {
                                        echo '<option value="' . $row["id"] . '">' . $row["type_animal"] . '</option>';
                                    }
                                    echo '</select>';
                                ?>
                                        <label for="type_animal.type_animal">Type de l'animal</label>
                                    </div>
                                </div>
                            </div>                        
                            <div class="container-fluid pt-4 form-group">
                                <div class="row">
                                    <div class="pr-2">
                                        <input type="date" name="ddn" id="ddn"></select>
                                        <label for="ddn">Date de naissance</label>
                                    </div>                                
                                </div>
                            </div>
                            <div class="container-fluid pt-4 form-group">
                                <div class="row">                                                                
                                <div class="pr-2">
                                <?php
                                    $res = $mysqli->query("SELECT id, nom, prenom FROM proprietaire ORDER BY nom");
                                    echo '<select class="form-control" name="proprietaire" id="proprietaire">';
                                    echo '<option value="-1">Sélectionnez type d\'animal</option>';
                                    while ($row = $res->fetch_assoc()) {
                                        echo '<option value="' . $row["id"] . '">' . $row["nom"] ." ". $row["prenom"] . '</option>';
                                    }
                                    echo '</select>';
                                ?>
                                        <label for="proprietaire.nom">Nom du propriétaire</label>
                                    </div>
                                </div>
                            </div>                        
                        </form>                    
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
        </div>
    </div>
    </div>

    <?php
        include_once "include/footer.php"
    ?>