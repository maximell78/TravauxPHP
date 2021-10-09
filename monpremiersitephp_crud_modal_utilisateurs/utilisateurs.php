<?php
  $page = "Utilisateurs";
  include_once 'include/header.php';
  include_once 'include/config.php';

  include_once 'include/utilisateurs/code_php/ajout.php';
?>

<div class="container mt-3">
  <div class="row">
    <div class="col">
      <h1>Liste des utilisateurs</h1>
    </div>
    <div class="col">
      <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalAjout">
        <svg class="bi bi-plus" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
          <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
        </svg>
        Ajouter un utilisateur
      </button>
    </div>
  </div>
      
  <?php 

    $mysqli = new mysqli($host, $username, $password, $database);

    // Vérifier la connexion
    if ($mysqli -> connect_errno) {
      echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
      exit();
    } 
    $res = $mysqli->query("SELECT * FROM utilisateurs ORDER BY utilisateur");
    $mysqli->close(); // Fermeture de la connexion 

    echo '<table class="table">';

    // Affichage de l'entête du tableau
    echo '<tr>';
    echo '<th>utilisateur</th>';
    echo '<th>courriel</th>';
    echo '</tr>';
    
    while ($row = $res->fetch_assoc()) {
      echo '<tr>';

      echo '<td>' . $row["utilisateur"] . '</td>';
      echo '<td>' . $row["courriel"] . '</td>';
    }
    echo '</table>';

    
    echo $messageAjout;
?>
    
</div>

<?php
  include_once 'include/utilisateurs/modals/ajout.php';
?>

<?php
  include_once 'include/bootstrap_scripts.php';
?>

<?php
  include_once 'include/footer.php';
?>