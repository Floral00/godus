<?php
    include('parametres.php');
    $connect = new PDO('mysql:host='.$server.';dbname='.$DB,$username,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
?>