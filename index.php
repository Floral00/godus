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


<!-- Contenu principale -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-xs-2"></div>
        <div class="col-md-8 col-xs-8 d-inline-flex justify-content-center">
            <img class="w-100 p-3" src="img/img-entete.jpg">
        </div>
        <div class="col-md-2 col-xs-2"></div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-3"></div>
        <div class="col-md-6 col-xs-6 d-inline-flex justify-content-center">
            <h1>Peinture Sudog</h1>
        </div>
        <div class="col-md-3 col-xs-3"></div>
    </div>
</div>

<!-- Pied de page -->
<?php
include("footer.php");
?>

</body>

</html>
