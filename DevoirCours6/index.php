<!-- index.php -->
<!-- Programmé par : Maxime Lacroix-Lemire -->
<!-- Dernière Mise À  Jour :  2021/05/17 -->

<?php
    include_once "include/config.php";
    $mysqli = new mysqli($host, $username, $password, $database);

?>
    <?php
        include_once "include/header.php";
    ?>
    <body>
        <h3 class="text-center">Bienvenue du côté Administrateur de la clinique</h3>
</body>


<?php
    include_once "include/footer.php"
?>