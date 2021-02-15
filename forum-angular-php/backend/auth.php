<?php


require_once 'mysql/mysqlQuery.php';
session_start();

function authentificate(){
    if(array_key_exists('login',$_POST) && array_key_exists('mdp', $_POST) ){
        $id = connectPost();
        if( $id!=-1) {
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['idUtilisateur'] = $id;
            return true;
        }
    }
    return false;
}

function isAuthenticated()
{
    return array_key_exists('idUtilisateur', $_SESSION) && array_key_exists('login', $_SESSION);
}


?>
