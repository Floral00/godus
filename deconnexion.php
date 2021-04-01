<?php

include('session.php');
include('database.php');

session_destroy();
echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
?>

