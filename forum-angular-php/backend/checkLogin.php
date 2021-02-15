<?php
require_once './helper.php';
require_once 'auth.php';

if(authentificate()){
    echo "salut";
//     print_r(getCours());
    sendMessage("");
}else{
    sendError("Le Mot de passe et/ou le Loginpw est invalide");
}
?>
