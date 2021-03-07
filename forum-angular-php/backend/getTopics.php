<?php
require_once 'helper.php';
require_once 'mysqlQuery.php';

$Topic = getTopic($_POST['idCours']);
//$NomCours = getNomCours($_POST['idCours']);
//$ Topic = array_merge($Topic,$NomCours);
//print_r($Topic);
sendMessage($Topic);
?>