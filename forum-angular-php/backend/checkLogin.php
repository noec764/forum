<?php
ini_set('display_errors',1);
require_once 'helper.php';
require_once 'auth.php';


if(authentificate()){
    sendMessage("");
}else{
    sendError("Le Mot de passe et/ou le Loginpw est invalide");
}
?>
