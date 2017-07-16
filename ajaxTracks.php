<?php
include 'includes/connexion_db.php';

$db = connect();

if(!empty($_GET['id'])) {

    $id = $_GET['id'];

    $query = $db->prepare('
        SELECT 
            titre.id,
            titre.numero,
            titre.libelle,
            titre.albumId,
            titre.chemin,
            titre.prix,
            album.libelle AS albumLibelle,
            artiste.nom AS artisteNom,
            genre.nom AS genreNom
        FROM titre, album, artiste, genre
        WHERE album.id = titre.albumId
        AND artiste.id = album.artisteId
        AND genre.id = artiste.genreId
        AND titre.albumId = :id
        ORDER BY genreNom ASC, artisteNom ASC, albumLibelle ASC, titre.numero ASC
    ');

    $query -> execute(array(
        ':id' => $id
    ));

} else {

    $query = $db->prepare('
        SELECT
            titre.id,
            titre.numero,
            titre.libelle,
            titre.chemin,
            titre.prix,
            titre.albumId,
            album.libelle AS albumLibelle,
            artiste.nom AS artisteNom,
            genre.nom AS genreNom
        FROM titre, album, artiste, genre
        WHERE album.id = titre.albumId
        AND artiste.id = album.artisteId
        AND genre.id = artiste.genreId
        ORDER BY genreNom ASC, artisteNom ASC, albumLibelle ASC, titre.numero ASC
    ');

    $query->execute();
}
    
$results = $query->fetchAll();

echo json_encode($results);

?>