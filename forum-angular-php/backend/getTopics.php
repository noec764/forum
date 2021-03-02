<?php
require_once 'helper.php';
require_once 'mysqlQuery.php';


$Topic = getTopic($_POST['idCours']);
sendMessage($Topic);
?>