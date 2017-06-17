<?php
// fournit la fonction connect()
include 'includes/connexion_db.php';

// récupération de l'id de l'utilisateur
if(isset($_GET['id'])) {

    $id = $_GET['id'];

    // 1) connexion
    $db = connect();

    // 2) requête
    $query = $db -> prepare('DELETE FROM users WHERE id = :id');

    // 3) exécution avec détermination des valeurs du placeholder
    $query -> execute(array(
        ':id' => $id
    ));

    // redirection vers la liste des joueurs (vers joueurs.php)
    header('location:utilisateurs.php');

}

?>