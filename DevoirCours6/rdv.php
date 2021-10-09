<!-- rdv.php -->
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
    <link rel="stylesheet" href="./css/style.css">
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
            $res = $mysqli->query("SELECT rdv.date_rdv, rdv.heure_rdv, rdv.duree_rdv, veterinaire.nom FROM rdv INNER JOIN veterinaire ON veterinaire.id = fk_veterinaire ORDER BY date_rdv");
    ?>    
                    
            <div class="container-fluid pb-3 ml-3">
                <div class="row ">
                <?php
            while ($row = $res->fetch_assoc()) {
    ?>    
                <div class="col-8 col-sm-4 col-md-3 col-lg-3 col-xl-2 card mr-3 mb-3 card-hover">                
                    Date :
                    <?php echo $row["date_rdv"]?></br>
                    Heure : 
                    <?php echo $row["heure_rdv"]?></br>
                    Durée :
                    <?php echo $row["duree_rdv"]?></br>
                    Nom du vétérinaire :
                    <?php echo $row["nom"]?>                        
                </div>
                <?php
            }
    ?>
                </div>            
            </div>        
    <?php        
        }
    ?>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="./boostrap/js/bootstrap.js"></script>
</body>
</html>