<!-- veterinaire.php -->
<!-- Programmé par : Maxime Lacroix-Lemire -->
<!-- Dernière Mise À  Jour :  2021/05/17 -->

<?php
    include_once "include/config.php";
    $mysqli = new mysqli($host, $username, $password, $database);

?>

<!DOCTYPE html>
<html lang="fr-ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinique Veterinaire TR</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
</head>
<body>
    
    <?php
        include_once "./include/header.php";
    ?>
    
    <?php 
        $mysqli = new mysqli($host, $username, $password, $database);
        if ($mysqli -> connect_errno) {
            echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error;
            exit();
        } else  {
            $res = $mysqli->query("SELECT * FROM veterinaire ORDER BY nom, prenom");
    ?>
        <table class="table">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
            </tr>
    
        <?php
            while ($row = $res->fetch_assoc()) {
    ?>
            <tr>
                <td><ul><li><?php echo $row["nom"]?></li></ul></td>
                <td><?php echo $row["prenom"]?></td>
            </tr>
        
    <?php
            }
    ?>
        </table>
    <?php        
        }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="./boostrap/js/bootstrap.js"></script>
</body>
</html>

joueurs.nom AS jnom, joueurs.prenom, personnages.nom AS pnom, classes.type_classes, races.type_races