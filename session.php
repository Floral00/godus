<?php
//On test si la session existe déjà (on évite ainsi d'ouvrir une session déjà existante)
if(session_id() == '' || !isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['pseudo']))
{
    $Verif_Utilisateur = 0;
}
else
{
    $Verif_Utilisateur = 1;
}
?>

