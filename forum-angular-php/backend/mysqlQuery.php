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
    $query = "SELECT * FROM topic WHERE idCours=?";
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

function getNomCours($idCours)
{

    global $PDO;
    $query = "SELECT nom FROM cours WHERE idCours=?";
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

function checkCours($idCours)
{
    global $PDO;
    $query = "SELECT * FROM cours_relation WHERE idCours=? AND idUtilisateur=?";
    $data = array($idCours, $_SESSION['idUtilisateur']);
    try {
        $prepare = $PDO->prepare($query);
        $prepare->execute($data);
        $resultats = $prepare->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        print_r(array('ERROR' => " Erreur ! " . $e->getMessage(), 'SQL' => $query, 'datas' => $data));
        exit();
    }
    if (empty($resultats)) {
        sendError('Lutilisateur  courant ne fait pas partie de ce cours');
        return false;
    }
    return true;
}


function searchIdTopic()
{
    global $PDO;

    $query = "SELECT count(*) FROM topic ";
    $data = array();
    try {
        $prepare = $PDO->prepare($query);
        $prepare->execute($data);
        $resultats = $prepare->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // en cas d'erreur :
        print_r(array('ERROR' => " Erreur ! " . $e->getMessage(), 'SQL' => $query, 'datas' => $data));
        exit();
    }
    return ($resultats[0]['count(*)'] + 1);

}

function verifyTopic()
{
    global $PDO;

    $query = "SELECT titreTopic FROM topic ";
    $data = array();
    try {
        $prepare = $PDO->prepare($query);
        $prepare->execute($data);
        $resultats = $prepare->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // en cas d'erreur :
        print_r(array('ERROR' => " Erreur ! " . $e->getMessage(), 'SQL' => $query, 'datas' => $data));
        exit();
    }
    print_r($resultats[0]);

}

function addTopic()
{
    global $PDO;
    $id = searchIdTopic();
    $query = "INSERT INTO `topic` (`idTopic`, `titreTopic`, `nbPosts`, `dateDernierMessage`, `idCours`) VALUES (?,?,?,?,?)";
    $data = array($id, $_POST['newTopic'], 0, date("y/m/d"), $_POST['idCours']);

    try {

        $prepare = $PDO->prepare($query);

        $exec = $prepare->execute($data);
        $resultats = $prepare->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        // en cas d'erreur :
        print_r(array('ERROR' => " Erreur ! " . $e->getMessage(), 'SQL' => $query, 'datas' => $data));
        exit();
    }
    if ($exec == TRUE) {
        sendMessage($id);
    }else{
        sendError("Quelque chose ne s'est pas bien passé");
    }
}

?>