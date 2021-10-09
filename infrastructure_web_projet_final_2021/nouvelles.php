<?php include_once('include/header.php'); ?>

  <!-- Page Content -->
  <div class="container">  
    <h1 class="my-4 text-center">Toutes les nouvelles</h1>
    <!-- Afficher la liste de toutes nouvelles ACTIVES en ordre chronologique (de la plus récente à la plus ancienne) -->
    <!-- L'affichage doit être le même que celui utilisé pour l'affichage des nouvelles par catégorie -->	
  </div>
  <?php
      $mysqli = new mysqli($host, $username, $password, $database);
      if ($mysql -> connect_errno) {
        echo "Échec de connexion à la base de donnée MySQL: " . $mysqli -> connect_error;
        exit();
      } else {
        $res = $mysqli -> query("SELECT * FROM nouvelles WHERE actif='1' ORDER BY date_nouvelle DESC");
      }
  ?>   
    
  <div class="container-fluid">
    <div class="row">
    <?php
      while ($row = $res -> fetch_assoc()){
    ?>
      <div class="col-6">  
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h3 class="text-center"><?php  echo $row["titre"]?></h3>
            </div>
            <div class="offset-2 col-4 pt-3">
              </br><h5><?php echo $row["date_nouvelle"]?></h5>
            </div>        
            <div class="col-4">
              <p><?php echo $row["description_courte"]?></p>
            </div>     
          </div>
        </div>
        <div class="container pt-3">
          <div class="row">
            <div class="offset-4 col-4 text-center pb-3">
              <a href="nouvelle.php?id=<?php echo $row["id"]?>" class="btn btn-primary">Plus d'informations</a>
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

