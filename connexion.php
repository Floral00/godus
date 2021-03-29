<?php
include("database.php");
include("session.php");
include("debut.php");
if(isset($_GET['Erreur']))
{
    $Erreur= $_GET['Erreur'];
}
else
{
    $Erreur=0;
}
?>

<body>

    <!-- Barre de navigation -->
<?php
include("navbar.php");
?>

    <!-- En-tête de la page -->
    <header class="masthead" style="background-image: url('img/vador.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Connexion</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principale -->

    <!-- Formulaire de connexion -->

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <?php
                if($Erreur==1)
                {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Veuillez vous connecter pour accéder à cette page !
                    </div>
                    <?php
                }
                ?>
                <form method="post" action="connexion.php">
                    <!-- Demande le pseudo de l'utilisateur -->
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Pseudo</label>
                            <input type="text" class="form-control" placeholder="Pseudo" name="pseudo" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <!-- Demande le mdp de l'utilisateur -->
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Mot de passe</label>
                            <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" name="connexion">Se connecter</button>
                    <br>
                    <a href ="inscription.php"><p style="text-align: center">Pas encore inscrit ?</p></a>
                </form>
            </div>
        </div>
    </div>

    <!-- Requete connexion-->

    <?php
    if(isset($_POST['connexion'])) {
        if (isset($_POST['mdp']))
            $mdp = $_POST['mdp'];
        else $mdp = " ";
        if (isset($_POST['pseudo']))
            $pseudo = $_POST['pseudo'];
        else $pseudo = " ";
        $mdp = sha1($_POST['mdp']); #permet de chiffer le mdp dans la bdd
        $res = $connect->query("SELECT COUNT(*) AS compteur FROM utilisateur WHERE pseudo='$pseudo'");
        $data = $res->fetch();
        $Compteur_Utilisateur = $data['compteur'];

        if ($Compteur_Utilisateur != 0) {
            $res = $connect->query("SELECT COUNT(*) AS compteur FROM utilisateur WHERE pseudo='$pseudo' AND mdp ='$mdp'");
            $data = $res->fetch();
            $Verif_Utilisateur = $data['compteur'];
            if ($Verif_Utilisateur == 1) {
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mdp'] = $mdp;
                echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
            }
        }
    }
    ?>

    <!-- Pied de page -->
    <?php
    include("footer.php");
    ?>

</body>

</html>