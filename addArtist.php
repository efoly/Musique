<?php  
include 'includes/classes/ArtistManager.class.php';
include_once 'includes/classes/Artist.class.php';
include_once 'includes/util.inc.php';
include 'includes/header.php';
include 'includes/menu.php';


if(isset($_POST['input'])) {
$a = $_POST;

$artist = new Artist($a);

    if ($artist->save()) {
        echo 'Artiste enregistré avec succès en base de données !';
    } else {
        echo "Erreur lors de l'insertion de l'artiste !";
    }

} else {
    echo "Le client n'a pas validé le formulaire.";
}

?>

<h1>Enregistrer un artiste</h1>

<?php

insertForm('includes/forms/addArtistForm.php');

include 'includes/footer.php';

?>