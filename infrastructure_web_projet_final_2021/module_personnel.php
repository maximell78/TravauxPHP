<?php  
  include_once "include/header.php";
?>
<!DOCTYPE html>
<html lang="fr-CA">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Projet Final </title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

  </head>

  <body>
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="my-4 text-center">Liste des personnages</h1>	
        <h4 class="text-center">Dans cette page, je vais afficher la liste des joueurs ainsi que leurs personnages. Ses enregistrements ont été créés lors du 1er projet.</h4>
      </div>
    </div>
  </div>

<!-- Liste des personnages -->
<?php 
        $mysqli = new mysqli($host, $username, $password, $db);
        if ($mysqli -> connect_errno) {
            echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error;
            exit();
        } else  {
            $res = $mysqli->query("SELECT joueurs.nom AS jnom, joueurs.prenom, personnages.nom AS pnom, classes.type_classes, races.type_races FROM joueurs INNER JOIN personnages ON joueurs.id = personnages.fk_joueurs INNER JOIN classes ON classes.id = personnages.fk_classes INNER JOIN races ON races.id = personnages.fk_races ORDER BY personnages.nom");
  ?>
<div class="container pt-5">
  <div class="row">
    <?php
      while ($row = $res->fetch_assoc()) 
      { 
    ?>
    <div class="col-lg-5 col-12 card bleu mb-5 mr-5">          
        <div class="container-fluid">
            <div class="row">                  
                <div class="col-12">
                    <h2 class="pt-4 text-center"><?php echo $row["pnom"]?></h2>                                                               
                </div>                    
            </div>
        </div>        
            <div class="container-fluid pt-5">
                <div class="row">
                    <div class="mr-3 col-6">
                        <p>
                          <strong>
                              Identification du joueur :                               
                          </strong>
                        </p>
                    </div>
                    <div class="pr-2">
                        <p><?php echo $row["prenom"]?></p>
                    </div>
                    <div>
                      <p><?php echo $row["jnom"]?></p>
                    </div>
                </div>
            </div>
            <div class="container-fluid pt-4 form-group">
                <div class="row">
                    <div class="col-6 mr-3">
                      <p>
                        <strong>
                            Classe du personnage :
                        </strong>
                      </p>
                    </div>                                
                    <div>
                      <div>
                        <p><?php echo $row["type_classes"]?></p>
                      </div>
                    </div>
                </div>
            </div>                        
            <div class="container-fluid pt-4 form-group">
                <div class="row">
                    <div class="col-6 mr-3">
                        <p>
                          <strong>
                            Race du personnage :
                          </strong>
                        </p>
                    </div>                    
                      <div>
                        <p><?php echo $row["type_races"]?></p>
                      </div>                            
                </div>
            </div>                             
    </div>
    <?php 
    }
    ?>
  </div>
</div>
<?php
  }
?>  

<?php include_once('include/footer.php'); 
$requete->close(); // Fermeture du traitement 
        
$mysqli->close(); // Fermeture de la connexion
?>
