<?php
session_start();
if (!isset($_SESSION['pseudo']))
{
    $Verif_Utilisateur = 0;
}
else
{
    $Verif_Utilisateur = 1;
}
?>

