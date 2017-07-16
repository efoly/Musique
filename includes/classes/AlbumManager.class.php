<?php
include 'Album.class.php';

class AlbumManager
{
    public $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=musique', 'root', '');

    }

    function getListFetched()
    {
        $query = $this->db->prepare('SELECT album.id, album.libelle, album.annee, album.artisteId FROM album');
        $query->execute();
        return $query->fetchAll(); // renvoie un tableau associatif
    }

    function getById($id)
    {
        $query = $this->db->prepare('SELECT * FROM album WHERE album.id = :id');
        $query->execute(array(
            ':id' => $id
        ));

        $album = new Album($query->fetch());
        return $album;
    }

}

?>