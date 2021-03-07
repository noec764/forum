<?php

require_once 'helper.php';
if ($_POST['newTopic'] == '') {
    sendError('Le sujet est vide veuillez remplir le sujet');
} else {

    if (verifyTopic() == true) {
        if (checkCours($_POST['idCours'])) {
            addTopic();
        }
    }else{
        sendError("Le sujet existe deja dans cette matiere");
    }

}

?>