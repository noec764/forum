<?php
ini_set('include_path', ini_get('include_path') . ':..');

require_once 'mysql/mysqlConnect.php';
global $_SESSION;

function connectPost()
{
    global $PDO;
    $query = "SELECT idUtilisateur FROM utilisateur WHERE login=? AND mdp=? ";
    $data = array($_POST['login'], $_POST['mdp']);
    $statement = $PDO->prepare($query); //Preparation
    $exec = $statement->execute($data); //execution
    $resultats = $statement->fetch(PDO::FETCH_ASSOC);
    if (empty($resultats)) {
        return -1;
    } else {
        return $resultats['idUtilisateur'];
    }
}


function getCours()
{
    global $PDO;
    $query = "SELECT * FROM cours WHERE idCours in (SELECT idCours FROM cours_relation WHERE idUtilisateur=?) ";
    $data = array($_POST['idUtilisateur']);
    $statement = $PDO->prepare($query); //Preparation
    $exec = $statement->execute($data); //execution
    $resultats = $statement->fetch(PDO::FETCH_ASSOC);

    return $resultats

}
?>