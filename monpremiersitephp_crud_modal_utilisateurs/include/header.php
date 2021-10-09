<?php 
  include_once 'login.php';
?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    
    <title><?php echo $page ?></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Logo ici :)</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if($page=='Accueil') echo 'active'; ?>">
            <a class="nav-link" href="index.php">Accueil</a>
          </li>
          <li class="nav-item <?php if($page=='Produits') echo 'active'; ?>">
            <a class="nav-link" href="produits.php">Produits</a>
          </li>
          <li class="nav-item <?php if($page=='Clients') echo 'active'; ?>">
            <a class="nav-link" href="clients.php">Clients</a>
          </li>
          <li class="nav-item <?php if($page=='Commandes') echo 'active'; ?>">
            <a class="nav-link" href="commandes.php">Commandes</a>
          </li>
          <li class="nav-item <?php if($page=='Utilisateurs') echo 'active'; ?>">
            <a class="nav-link" href="utilisateurs.php">Utilisateurs</a>
          </li>
        </ul>
        <ul class="navbar-nav">   
          <?php
            if(!isset($_SESSION["utilisateur"])) {
              echo $messageErreurLogin;
          ?>      
            <li class="nav-item">  
              <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modalConnexion">
                Connexion
              </button>
            </li>
          <?php
            } else {
          ?>
            <li class="nav-item mr-2"> 
              <span class="navbar-text">Bonjour <?php echo $_SESSION["utilisateur"]; ?>!</span>   
            </li>
            <li class="nav-item">  
              <form method="POST">
                <button type="submit" name="deconnexionSubmit" class="btn btn-sm btn-outline-primary">
                  Déconnexion
                </button>
              </form>
            </li>
          <?php
            }
          ?>
        </ul>
      </div>
    </nav>

<?php
  include_once 'modals/login.php';
?>