<?php
    include('database.php');
    include('session.php');
    include('debut.php');
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
                        <h1>Inscription</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principale -->

    <!-- Requete formulaire d'inscription -->
    <?php
        if(isset($_POST['inscription']))
        {
            if(!empty($_POST['mail']) && !empty($_POST['login']) && !empty($_POST['mdp']) && !empty($_POST['mdp2']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['tel']) && !empty($_POST['adresse']))
            {
                if($_POST['mdp'] == $_POST['mdp2'])
                {
                $mdp = sha1($_POST['mdp']); #permet de chiffer le mdp dans la bdd
                $insertsql = $connect->prepare('INSERT INTO user(mail, login, mdp, prenom, nom, tel, admin, adresse, dh_creation) VALUES(?, ?, ?, ?, ?, ?,0,?,current_date) ');
                $insertsql->execute(array($_POST['mail'], $_POST['login'], $mdp, $_POST['prenom'], $_POST['nom'], $_POST['tel'], $_POST['adresse'])); #envoie les infos dans la table utilisateur
                if($insertsql->rowCount() == 1) #permet de vérifier si les mdp correspondent
                {

                }
                else
                {
                    echo "Les mots de passe ne sont pas identiques";
                }
                }
            else
            {
                echo "Tous les champs doivent être remplis !";
            }
            }
        }
    ?>

    <!-- Formulaire d'inscription -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <form action="" method="POST">
                    <!-- Demande l'adresse mail de l'utilisateur -->
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Adresse mail</label>
                            <input type="email" class="form-control" placeholder="Adresse mail" name="mail" required data-validation-required-message="Please enter your email address.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <!-- Demande le login de l'utilisateur -->
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Login</label>
                            <input type="text" class="form-control" placeholder="Login" name="login" required data-validation-required-message="Please enter your name.">
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
                    <!-- Demande la confirmation du mdp de l'utilisateur -->
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Confirmer votre mot de passe</label>
                            <input type="password" class="form-control" placeholder="Confirmer votre mot de passe" name="mdp2" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <!-- Demande le prénom de l'utilisateur -->
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Prénom</label>
                            <input type="text" class="form-control" placeholder="Prénom" name="prenom" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <!-- Demande le nom de l'utilisateur -->
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Nom</label>
                            <input type="text" class="form-control" placeholder="Nom" name="nom" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <!-- Damande le téléphone de l'utilisateur -->
                    <div class="control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Téléphone</label>
                            <input type="tel" class="form-control" placeholder="Téléphone" name="tel" required data-validation-required-message="Please enter your phone number.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <!-- Damande l'adresse de l'utilisateur -->
                    <div class="control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Adresse</label>
                            <input type="text" class="form-control" placeholder="Adresse" name="adresse" required data-validation-required-message="Please enter your phone number.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>

                    <br>
                    <div id="success"></div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="inscription" value="inscription">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    <?php
    include("footer.php");
    ?>

</body>

</html>

