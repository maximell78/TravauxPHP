<?php
  $page = "Clients";
  include_once 'include/header.php';
  include_once 'include/config.php';
?>

  <div class="container">
  <h1>Liste des clients dans une liste déroulante</h1>
  
  <?php
    $mysqli = new mysqli($host, $username, $password, $database);

    // Vérifier la connexion
    if ($mysqli -> connect_errno) {
      echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
      exit();
    }   
    $res = $mysqli->query("SELECT id, nom FROM clients ORDER BY nom");

    echo '<select class="form-control selectpicker" data-live-search="true" name="clientId">';
    echo '<option value="-1">Sélectionnez un client</option>';
    while ($row = $res->fetch_assoc()) {
        echo '<option value="' . $row["id"] . '">' . $row["nom"] . '</option>';
    }
    echo '</select>';
  ?>

<?php
  include_once 'include/bootstrap_scripts.php';
  include_once 'include/footer.php';
?>