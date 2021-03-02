<?php
require_once 'helper.php';
require_once 'mysqlQuery.php';


 $Cours = getCours($_SESSION['idUtilisateur']);
 sendMessage($Cours);
?>