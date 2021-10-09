<?php
  $page = "Commandes";
  include_once 'include/header.php';
  include_once 'include/config.php';
?>

<div class="container">
  <h1>Liste des commandes</h1>

  <?php
      $mysqli = new mysqli($host, $username, $password, $database);

      // Vérifier la connexion
      if ($mysqli -> connect_errno) {
          echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error;
          exit();
      }
      $res = $mysqli->query("SELECT commandes.id, dateCommande, nom FROM commandes INNER JOIN clients on fk_client = clients.id ORDER BY dateCommande");
      
      echo "<table class='table'>";

      // Affichage de l'entête du tableau
      echo "<tr>";
      echo "<th>#</th>";
      echo "<th>Date</th>";
      echo "<th>Nom</th>";
      echo "</tr>";
      
      while ($row = $res->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["id"] . "</td>";
          echo "<td>" . $row["dateCommande"] . "</td>";
          echo "<td>" . $row["nom"] . "</td>";
          echo "</tr>";
      }
      echo "</table>";
  ?>

</div>

<?php
  include_once 'include/bootstrap_scripts.php';
  include_once 'include/footer.php';
?>