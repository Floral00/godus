<?php
include('database.php');
include('session.php');
include("debut.php");
?>

<body>

<!-- Barre de navigation -->
<?php
include("navbar.php");
?>

<!-- En-tête de la page -->
<header class="masthead" style="background-image: url('img/fm-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Espace de contrebande</h1>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Contenu principale -->
<div class="container">
    <div class="row">
<?php
$SQL = "SELECT * FROM produits";

$result = $connect->query($SQL);
while($data = $result->fetch())
{
    ?>
    <div class="mx-auto" style="padding-top: 50px">
        <div class="card mb-3" style="width: 310px; height: 550px">
            <div class="card-body">
                <h4 style="text-align: center; padding-bottom: 20px" class="card-title"  ><?php echo $data["nom"]; ?></h4>
                <p style="text-align:center;"><img src="<?php echo $data["image"]?>"width="200px" height="250px"></p>
                <h4 style="text-align: center; padding-bottom: 20px" class="card-title"  ><?php echo $data["prix"]; ?></h4>
                <h6 style="text-align: center; padding-bottom: 1px" class="card-title"  ><?php echo "Poids : ".$data["poids"]; ?></h6>
                <h6 style="text-align: center; padding-bottom: 20px" class="card-title"  ><?php echo "Dimensions : " .$data["dimensions"]; ?></h6>
            
            </div>
        </div>
    </div>
    <?php
}
?>

</div>
</div>
<!-- Pied de page -->
<?php
include("footer.php");
?>

</body>

</html>
