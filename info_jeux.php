<?php
include('database.php');
include('session.php');
include("debut.php");
if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
} else {
    echo "<script type='text/javascript'>document.location.replace('jeux.php');</script>";
}
?>

<body>

<!-- Barre de navigation -->
<?php
include("navbar.php");
?>

<!-- En-tête de la page -->
<?php
$SQL = "SELECT * FROM jeux WHERE jeux.id ='$ID'";

$result = $connect->query($SQL);
while ($data = $result->fetch()) {

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
                        <li class="list-group-item"><b>Studio :</b> <?php echo $data["studio"]; ?></li>
                        <li class="list-group-item"><b>Pegi :</b> <?php echo $data["pegi"]; ?></li>
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
