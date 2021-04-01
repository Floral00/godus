<?php
include('database.php');
include('session.php');
include("debut.php");
?>
<head>
    <script></script>
</head>
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
                    <h1>Les films</h1>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Contenu principale -->

<div class="container">
    <div class="row">

        <?php
        $SQL = "SELECT * FROM film";

        $result = $connect->query($SQL);
        while($data = $result->fetch())
        {
            $lien = "info_films.php?ID=".$data["id"];
            ?>

            <div class="mx-auto" style="padding-top: 50px">
                <div class="card mb-3" style="width: 300px; height: 470px">
                    <div class="card-body">
                        <a href="<?php echo $lien;?>"><h4 style="text-align: center; padding-bottom: 20px" class="card-title"  ><?php echo $data["nom"]; ?></h4></a>
                        <p style="text-align:center;"><img src="<?php echo $data["image"]?>"width="200px" height="300px" ></p>

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

<script type="text/javascript">
    $.document()


</script>
</body>


</html>

