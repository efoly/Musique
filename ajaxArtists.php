<?php
include 'includes/connexion_db.php';

$db = connect();

if(!empty($_GET['id'])) {

    $id = $_GET['id'];

    $query = $db -> prepare('
        SELECT 
            artiste.id, 
            artiste.nom, 
            artiste.genreId
        FROM artiste
        WHERE artiste.genreId = :id
        ORDER BY artiste.nom ASC
    ');

    $query -> execute(array(
        ':id' => $id
    ));

} else {

    $query = $db -> prepare('
        SELECT
            artiste.id, 
            artiste.nom, 
            artiste.genreId
        FROM artiste
        ORDER BY artiste.nom ASC
    ');

    $query->execute();
}
    
$results = $query->fetchAll();

echo json_encode($results);

?>