<?php
include 'includes/connexion_db.php';

$db = connect();

$query = $db -> prepare('
    SELECT 
        genre.id,
        genre.nom
    FROM genre
    ORDER BY genre.nom
');
$query -> execute();
$results = $query -> fetchAll();

echo json_encode($results);

?>