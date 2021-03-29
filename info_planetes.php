<?php
include('database.php');
include('session.php');
include("debut.php");
if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
} else {
    echo "<script type='text/javascript'>document.location.replace('planetes.php');</script>";
}
?>

<body>

<!-- Barre de navigation -->
<?php
include("navbar.php");
?>

<!-- En-tête de la page -->
<?php
$SQL = "SELECT * FROM planete, typeplanete, regionplanete
        WHERE planete.id_type = typeplanete.id 
        AND planete.id_region = regionplanete.id 
        AND planete.id='$ID'";

$result = $connect->query($SQL);
while ($data = $result->fetch()) {

    $SQL_2 = "SELECT * FROM espece JOIN especes_planetes ON espece.id = especes_planetes.id_espece WHERE id_planete = $data[0]";

    ?>
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1><?php echo $data["nom"]; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principale -->

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <p style=""><?php echo $data["bio"]; ?></p>
            </div>
            <div class="col-lg-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo $data["image"] ?>">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Diamètre :</b> <?php echo $data["nom_type"]; ?></li>
                        <li class="list-group-item"><b>Type :</b> <?php echo $data["nom_type"]; ?></li>
                        <li class="list-group-item"><b>Région :</b> <?php echo $data["nom_region"]; ?></li>
                        <li class="list-group-item"><b>Espèces :</b>
                            <?php
                            $result_2 = $connect->query($SQL_2);
                            while ($data_2 = $result_2->fetch())
                                echo $data_2["nom"] . "," . "\n";
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <?php
}
?>

</div>

<!-- Pied de page -->
<?php
include("footer.php");
?>

</body>

</html>
