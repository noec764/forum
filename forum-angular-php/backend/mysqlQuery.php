<?php

require_once 'mysqlConnect.php';
global $_SESSION;


function connectPost()
{
    global $PDO;
    $query = "SELECT idUtilisateur FROM utilisateur WHERE login=? AND password=? ";

    $data = array($_POST['login'], $_POST['password']);
    try {
        $prepare = $PDO->prepare($query);
        $prepare->execute($data);
        $resultats = $prepare->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // en cas d'erreur :
        print_r(array('ERROR' => " Erreur ! " . $e->getMessage(), 'SQL' => $query, 'datas' => $data));
        exit();
    }


    if (empty($resultats)) {
        return -1;
    } else {
        $_SESSION['idUtilisateur'] = $resultats['idUtilisateur'];
        $_SESSION['login'] = $_POST['login'];
        return $resultats['idUtilisateur'];
    }
}


function getCours($idUtilisateur)
{
    global $PDO;
    $query = "SELECT * FROM cours c WHERE c.idCours IN (SELECT r.idCours FROM cours_relation r WHERE r.idUtilisateur =?)";
    $data = array($idUtilisateur);
    try {
        $prepare = $PDO->prepare($query);
        $prepare->execute($data);
        $resultats = $prepare->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // en cas d'erreur :
        print_r(array('ERROR' => " Erreur ! " . $e->getMessage(), 'SQL' => $query, 'datas' => $data));
        exit();
    }
    return $resultats;

}
function getTopic($idCours)
{
    global $PDO;
    $query = "SELECT * FROM topic t WHERE t.idCours=?";
    $data = array($idCours);
    try {
        $prepare = $PDO->prepare($query);
        $prepare->execute($data);
        $resultats = $prepare->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // en cas d'erreur :
        print_r(array('ERROR' => " Erreur ! " . $e->getMessage(), 'SQL' => $query, 'datas' => $data));
        exit();
    }
    return $resultats;

}

?>