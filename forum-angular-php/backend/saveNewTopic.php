<?php

require_once 'helper.php';

if($_POST['newTopic']==''){
    sendError('Le sujet est vide veuillez remplir le sujet');
}else{
    verifyTopic();
    if(checkCours($_POST['idCours'])){
        addTopic();
    }
}

?>