<?php
ini_set('include_path', ini_get('include_path') . ':..');

require_once 'config.php';
global  $mysqlHost,$mysqlDB,$charset,$mysqlLogin,$mysqlPassword;
//Créationd e l'instance PDO et connexion a la BD
$dsn="mysql:host=$mysqlHost;".
    "dbname=$mysqlDB;".
    "charset=$charset";
//Options
$opt= array(
  PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES=>false);

$PDO=new PDO($dsn,$mysqlLogin,$mysqlPassword,$opt);
?>