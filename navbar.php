<!-- Barre de navigation -->

<!-- Barre de navigation -->

<nav class="navbar navbar-custom navbar-fixed-top navbar-expand-sm">
    <div class="container-fluid">
        <div class="navbar-header">

            <a class="navbar-brand" href="index.php">Peinture Sudog</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div id="navbar" class="dropdown float-right">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form action="/recherche.php" class="form-inline">
                        <input style="float: none;display: block; border-radius: 20px; height: 1.5em;" type="text" placeholder="Recherche.." name="search">
                        <button class="btn bg-transparent" style="float: right;  cursor: pointer; margin-right: 16px; background-color:transparent;" type="submit"><span class="glyphicon glyphicon-search" style="color: white"></span></button>
                    </form>
                </li>
                <br/>
                <li style="padding-right: 10px">
                    <a href="oeuvre.php">Oeuvres</a>
                </li>

                <li style="padding-right: 10px">

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
                        echo '<a href="' . $redirection_shop . '">Panier</a>'

                        ?>
                </li>
                <li style="padding-right: 10px">
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
                        echo '<a href="'.$redirection_forum.'">Nous contacter</a>'
                        ?>
                </li>
                <!-- Onglet connexion -->
                <li style="padding-right: 10px">
                        <?php
                        if(isset($_SESSION['login'])) {
                            if ($_SESSION['login'] != '') {
                                echo '<a style="padding-right: 10px" href="utilisateur.php?user='.$_SESSION["login"].'">' . $_SESSION["login"] . '</a>';
                                echo '<a style="padding-right: 0px" href="deconnexion.php">Deconnexion</a>';
                            } else {
                                echo '<a href="connexion.php">Connexion</a>';
                            }
                        }
                        else {
                            echo '<a href="connexion.php">Connexion</a>';
                        }
                        ?>
                </li>

            </ul>
        </div>
    </div>
</nav>

