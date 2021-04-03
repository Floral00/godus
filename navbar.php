<!-- Barre de navigation -->

<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav" style="background-image: url('img/home-bg.jpg')">
    <div class="container">
        <a class="navbar-brand" href="index.php">Peinture Sudog</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Côté droit de la barre de navigation avec les différents onglets -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="/recherche.php" class="form-inline">
                        <input style="float: none;display: block; border-radius: 20px; height: 1.5em;" type="text" placeholder="Recherche.." name="search">
                        <button style="float: right;  cursor: pointer; margin-right: 16px;" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </li>
                <!-- Onglet oeuvres -->
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link drop">Nos oeuvres </a>
                        <div class="dropdown-content">
                            <a href="oeuvre.php?TYPE=huile">Nos peintures à l'huile</a>
                            <a href="oeuvre.php?TYPE=fresque"> Nos fresques</a>
                            <a href="oeuvre.php?TYPE=murale">Nos peintures murales</a>
                            <a href="oeuvre.php?TYPE=bois">Nos peintures sur bois</a>
                        </div>
                    </div>
                </li>
                <!-- Onglet Panier -->
                <li class="nav-item">
                    <div class="dropdown">
                        <?php
                        $redirection_shop = "";
                        if(isset($_SESSION['login'])) {
                            if ($_SESSION['login'] != '') {
                                $redirection_shop = "oeuvre.php";
                            } else {
                                $redirection_shop = "connexion.php?Erreur=1";
                            }
                        }
                        else {
                            $redirection_shop = "connexion.php?Erreur=1";
                        }
                        echo '<a class="nav-link drop" href="' . $redirection_shop . '">Panier</a>'

                        ?>
                    </div>
                </li>
                <!-- Onglet forum -->
                <li class="nav-item">
                    <div class="dropdown">
                        <?php
                        $redirection_forum = "";
                        if(isset($_SESSION['login'])) {
                            if ($_SESSION['login'] != '') {
                                $redirection_forum = "forum.php";
                            } else {
                                $redirection_forum = "connexion.php?Erreur=1";
                            }
                        }
                        else {
                            $redirection_forum = "connexion.php?Erreur=1";
                        }
                        echo '<a class="nav-link drop" href="'.$redirection_forum.'">Nous contacter</a>'
                        ?>
                    </div>
                </li>
                <!-- Onglet connexion -->
                <li class="nav-item">
                    <div class="dropdown">
                        <?php
                        if(isset($_SESSION['login'])) {
                            if ($_SESSION['login'] != '') {
                                echo '<a class="nav-link drop" href="">' . $_SESSION["login"] . '</a>';
                                echo '<div class="dropdown-content">';
                                echo '<a href="deconnexion.php">Deconnexion</a>';
                            } else {
                                echo '<a class="nav-link drop" href="connexion.php">Connexion</a>';
                            }
                        }
                        else {
                            echo '<a class="nav-link drop" href="connexion.php">Connexion</a>';
                        }
                        ?>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>