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
  
      if ($requete = $mysqli->prepare("SELECT * FROM nouvelles INNER JOIN categories ON nouvelles.fk_categorie =categories.id WHERE categories.id=? AND nouvelles.actif='1' ORDER BY nouvelles.date_nouvelle DESC ")) {  // Création d'une requête préparée 
  
      $requete->bind_param("s", $_GET['id']); // Envoi des paramètres à la requête
      $requete->execute(); // Exécution de la requête
  
      $result = $requete->get_result(); // Récupération de résultats de la requête
      $nouvelle = $result->fetch_assoc(); // Récupération de l'enregistrement
      
      }

    include_once('include/header.php');    
?>
  <div class="container-fluid pt-3 pb-3">
    <div class="row">
      <div class="col-12">
        <h1 class="text-center"> <?php echo $nouvelle["categorie"] ?></h1>
      </div>
    </div>
  </div>

  <!-- Page Content -->
  
  <?php
      $mysqli = new mysqli($host, $username, $password, $database);
      if ($mysql -> connect_errno) {
        echo "Échec de connexion à la base de donnée MySQL: " . $mysqli -> connect_error;
        exit();
      } else {
        $res = $mysqli -> query("SELECT * FROM nouvelles WHERE actif='1' AND fk_categorie= ORDER BY date_nouvelle DESC");
      }
  ?> 

  <div class="container-fluid">
    <div class="row">
    <!-- Je ne comprend pas mais le while ne fonctionne pas
    <?php
      //while ($row = $res -> fetch_assoc()){
    ?>
    -->
      <div class="col-6">      
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h3 class="text-center"><?php  echo $nouvelle["titre"]?></h3>
            </div>
            <div class="offset-2 col-4 pt-3">
              </br><h5><?php echo $nouvelle["date_nouvelle"]?></h5>
            </div>        
            <div class="col-4">
              <p><?php echo $nouvelle["description_courte"]?></p>
            </div>     
          </div>
        </div>
        <div class="container pt-3">
          <div class="row">
            <div class="offset-4 col-4 text-center pb-3">
              <a href="nouvelle.php?id=<?php echo $nouvelle["id"]?>" class="btn btn-primary">Plus d'informations</a>
            </div>
          </div>
        </div>
      </div> 
      <!--
      <?php
      //}
      ?>
      -->
    </div>
  </div>
  <?php
    include_once 'include/footer.php'
  ?>

