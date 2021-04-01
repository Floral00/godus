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
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <?php  var_dump($_SESSION);?>
                    <h1>HOLOCRON</h1>
                    <span class="subheading">A Star Wars Site</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Contenu principale -->

<!-- Pied de page -->
<?php
include("footer.php");
?>

</body>

</html>
