<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="index.php">HOLOCRON</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Côté droit de la barre de navigation avec les différents onglets -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <!-- Onglet univers Star Wars -->
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link drop">L'univers</a>
                            <div class="dropdown-content">
                                <a href="personnages.php">Les personnages</a>
                                <a href="planetes.php">Les planètes</a>
                                <a href="affiliations.php">Les affiliations</a>
                                <a href="especes.php">Les espèces</a>
                            </div>
                    </div>
                </li>
                <!-- Onglet oeuvres Star Wars -->
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link drop">Les oeuvres Star Wars</a>
                            <div class="dropdown-content">
                                <a href="films.php">Les films</a>
                                <a href="series.php">Les séries</a>
                                <a href="jeux.php">Les jeux vidéos</a>
                            </div>
                    </div>
                </li>
                <!-- Onglet forum -->
                <li class="nav-item">
                    <div class="dropdown">
                        <?php
                        $redirection_forum = "";
                        if($Verif_Utilisateur == 1){
                            $redirection_forum = "forum.php";
                        }
                        else{
                            $redirection_forum = "connexion.php?Erreur=1";
                        }
                        echo '<a class="nav-link drop" href="'.$redirection_forum.'">Forum</a>'
                        ?>
                    </div>
                </li>
                <!-- Onglet boutique -->
                <li class="nav-item">
                    <div class="dropdown">
                         <?php
                            $redirection_shop = "";
                            if($Verif_Utilisateur == 1){
                                $redirection_shop = "contrebandier.php";
                            }
                            else{
                                $redirection_shop = "connexion.php?Erreur=1";
                            }
                            echo '<a class="nav-link drop" href="'.$redirection_shop.'">Espace de contrebande</a>'
                          ?>
                    </div>
                </li>

                <!-- Onglet connexion -->
                <li class="nav-item">
                    <div class="dropdown">
                        <?php
                            if($Verif_Utilisateur == 1)
                            {
                                echo '<a class="nav-link drop" href="">'.$_SESSION["pseudo"].'</a>';
                                echo '<div class="dropdown-content">';
                                echo '<a href="deconnexion.php">Deconnexion</a>';
                            }
                            else{
                                echo'<a class="nav-link drop" href="connexion.php">Connexion</a>';
                            }
                        ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>