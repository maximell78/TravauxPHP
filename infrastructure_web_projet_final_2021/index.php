<?php
    include_once('include/header.php');
    $mysqli = new mysqli($host, $username, $password, $database);
?>
  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('http://placehold.it/1900x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Image #1</h3>
            <p>Description de l'image #1.</p>
          </div>
        </div>
        <!-- Slide Two - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('http://placehold.it/1900x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Image #2</h3>
            <p>Description de l'image #2.</p>
          </div>
        </div>
        <!-- Slide Three - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('http://placehold.it/1900x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Image #2</h3>
            <p>Description de l'image #3.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Précédent</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Suivant</span>
      </a>
    </div>
  </header>

  <!-- Page Content -->
  <?php
      $mysqli = new mysqli($host, $username, $password, $database);
      if ($mysql -> connect_errno) {
        echo "Échec de connexion à la base de donnée MySQL: " . $mysqli -> connect_error;
        exit();
      } else {
        $res = $mysqli -> query("SELECT * FROM nouvelles WHERE actif='1' ORDER BY date_nouvelle DESC LIMIT 3");
      }
  ?>
  <div class="container">
    <h1 class="my-4 text-center">Projet final</h1>
    <!-- Marketing Icons Section -->              
    <div class="row">
      <?php
        while ($row = $res -> fetch_assoc()){
      ?>
      <div class="col-8 col-sm-4 col-md-3 col-lg-3 col-xl-3 mr-3 mb-3">
        <div class="card h-100">
          <h4 class="card-header"><?php echo $row["titre"]?></h4>
          <div class="card-body">
            <h6 class="card-title"><?php echo $row["date_nouvelle"]?></h6>
            <p class="card-text"><?php echo $row["description_courte"]?></p>
          </div>          
          <div class="card-footer">
            <a href="nouvelle.php?id=<?php echo $row["id"]?>" class="btn btn-primary">Plus d'informations</a>
          </div>
        </div>
      </div>
      <?php
        }
      ?>	
    </div>
  </div>
  <!-- /.container -->

<?php include_once 'include/footer.php'; 
$requete->close(); // Fermeture du traitement 

$mysqli->close(); // Fermeture de la connexion
?>
