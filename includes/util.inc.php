<?php
include_once 'access.inc.php';

function insertForm($form) {

    if(isLogged() && getRole() == 'admin') {

        include $form;

    } else {

        echo '<p>Veuillez vous connecter et/ou Droits insuffisants pour accéder à cette ressource !</p>';

    }
}

?>