<!-- header.php -->
<!-- Programmé par : Maxime Lacroix-Lemire -->
<!-- Dernière Mise À  Jour :  2021/08/17 -->

<?php
  include_once "include/config.php";
  // Vérification que l'action d'ajout a été soumise et que tous les champs sont présents
  if(isset($_POST['connexionSubmit']) && isset($_POST['utilisateur_login']) && isset($_POST['mot_de_passe_login'])) { 
    $mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
    if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue
      echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
    } 
    if ($requete = $mysqli->prepare("SELECT mot_de_passe FROM utilisateurs WHERE utilisateur = ?")) {  // Création d'une requête préparée 
      $requete->bind_param("s", $_POST['utilisateur_login']); // Envoi des paramètres à la requête. 

      $requete->execute(); // Exécution de la requête
      $result = $requete->get_result(); // Récupération de résultats de la requête
      $utilisateur = $result->fetch_assoc(); // Récupération de l'enregistrement
      if(password_verify($_POST['mot_de_passe_login'], $utilisateur["mot_de_passe"])) {
        // Confirmer la connexion
        $_SESSION["utilisateur"] = $_POST['utilisateur_login'];
      } else {
        // Erreur de connexion
        $messageErreurLogin = '<li class="nav-item mr-2">Erreur d\'authentification</li>';
      }

      $requete->close(); // Fermeture du traitement 
    } else {
      echo $requete->error;
    }

    $mysqli->close(); // Fermeture de la connexion 
  } 

  if(isset($_POST['deconnexionSubmit'])) {
    unset($_SESSION["utilisateur"]);
  }
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

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Projet Final</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">            
            <li class="nav-item">
              <a class="nav-link" href="enonce.php">Énoncé</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Nouvelles
              </a>
              <?php
                $mysqli = new mysqli($host, $username, $password, $database);
                if ($mysql -> connect_errno) {
                  echo "Échec de connexion à la base de donnée MySQL: " . $mysqli -> connect_error;
                  exit();
                } else {
                  $res = $mysqli -> query("SELECT * FROM categories ORDER BY id");
                }
                ?>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                <?php
                while ($row = $res -> fetch_assoc()){                
                ?>
                <a class="dropdown-item" href="nouvelles_categorie.php?id=<?php echo $row["id"]?>"><?php echo $row["categorie"]?></a>
                <?php
                }
              ?>
                <a class="dropdown-item" href="nouvelles.php">Toutes les nouvelles</a>
              </div>              
            </li>
            <li class="nav-item">
              <a class="nav-link" href="module_personnel.php">Module personnel</a>
            </li>            
    
            <!-- Le menu Administration doit s'afficher seulement lorsque l'utilisateur est connecté !-->
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Administration
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPages">
                <a class="dropdown-item" href="administration_nouvelles.php">Nouvelles</a>
              </div>              
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
            </li>
            <li class="nav-item mr-2"> 
              <a class="nav-link dropdown-toggle" href="enonce.php" id="navbarDropdownPages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Administration
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPages">
                <a class="dropdown-item" href="administration_nouvelles.php">Nouvelles</a>
              </div>
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
      </div>
    </nav>
    
  <!-- Formulaire de connexion -->
  
  <div class="modal fade" id="modalConnexion" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Connexion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input class="form-control" type="text" placeholder="Utilisateur" id="utilisateur_login" name="utilisateur_login" required>
            <br>
            <input class="form-control" type="password" placeholder="Mot de passe" id="mot_de_passe_login" name="mot_de_passe_login" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="connexionSubmit">Connexion</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>          
        </div>
      </form>
    </div>
  </div>
</div>	