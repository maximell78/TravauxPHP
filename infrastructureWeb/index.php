<!-- index.php -->
<!-- Programmé par : Maxime Lacroix-Lemire -->
<!-- Dernière Mise À  Jour :  2021/05/17 -->

<?php
    include_once "include/config.php";
    $mysqli = new mysqli($host, $username, $password, $database);

?>


<html>
 <head>
  <title>Test PHP</title>
 </head>
 <body>
 
    <?php
    if ($mysqli -> connect_errno) {
        echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error;
        exit();
    } else  {
        echo "Connexion réussie!!" . "</br>";
    }

    $res = $mysqli->query("SELECT code, produit, prix_vente, qte_stock FROM produits ORDER BY code");
    
    while ($row = $res->fetch_assoc()) {
        echo $row["code"] . ', ' . $row["produit"] . ", " . $row["prix_vente"] . "$ , " . $row["qte_stock"] .  '<br>';
    }
    
    ?>

    

 </body>
</html>
