<?php
include 'includes/connexion_db.php';

$db = connect();

if(!empty($_GET['id'])) {

    $id = $_GET['id'];

    $query = $db->prepare('
        SELECT 
            album.id,
            album.libelle,
            album.annee,
            album.artisteId
        FROM album
        WHERE album.artisteId = :id
        ORDER BY album.libelle ASC
    ');

    $query -> execute(array(
        ':id' => $id
    ));

} else {

    $query = $db->prepare('
        SELECT
            album.id,
            album.libelle,
            album.annee,
            album.artisteId
        FROM album
        ORDER BY album.libelle ASC
    ');

    $query->execute();
}
    
$results = $query->fetchAll();

echo json_encode($results);

?>