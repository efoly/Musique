<?php
include 'Artist.class.php';

class ArtistManager
{
    public $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=musique', 'root', '');

    }

    function getListFetched()
    {
        $query = $this->db->prepare('SELECT artiste.id, artiste.nom, artiste.genreId FROM artiste ORDER BY artiste.nom ASC');
        $query->execute();
        return $query->fetchAll(); // renvoie un tableau associatif
    }

    function getById($id)
    {
        $query = $this->db->prepare('SELECT * FROM artiste WHERE artiste.id = :id');
        $query->execute(array(
            ':id' => $id
        ));

        $artiste = new Artist($query->fetch());
        return $artiste;
    }

}

?>