<?php
define('VISITEUR',1);
define('INSCRIT',2);
define('MODO',3);
define('ADMIN',4);
?>

<?php
define('ERR_IS_CO','Vous ne pouvez pas accéder à cette page si vous n\'êtes pas connecté');
?>

<?php
exit('<div id="error"><p>'.$mess.'</p>
   <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div></div></body></html>');
?>




