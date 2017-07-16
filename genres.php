<?php   
include_once 'includes/access.inc.php';
include 'includes/header.php';
include 'includes/menu.php';

if(isLogged()) {

    echo '<p>Bienvenue <strong>' . getAccount() . '</strong> sur notre site musical !</p>';
    include 'includes/tracks/tracks.php';

} else {

    echo '<strong>Veuillez vous connecter pour accéder à cette ressource !</strong>';

}

include 'includes/footer.php';

?>