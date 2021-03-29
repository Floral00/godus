<?php
session_start();
include('database.php');

unset($_SESSION['pseudo']);
unset($_SESSION['mdp']);

$_SESSION = array();
session_destroy();

echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
?>

