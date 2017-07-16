<?php
include_once 'Genre.class.php';

class GenreManager
{
    public $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=musique', 'root', '');

    }

    function getListFetched()
    {
        $query = $this->db->prepare('SELECT genre.id, genre.nom FROM genre ORDER BY genre.nom ASC');
        $query->execute();
        return $query->fetchAll(); // renvoie un tableau associatif
    }

    function getById($id)
    {
        $query = $this->db->prepare('SELECT genre.id, genre.nom FROM genre WHERE id = :id');
        $query->execute(array(
            ':id' => $id
        ));

        //return $query->fetch(); // renvoie un tableau associatif

        $genre = new Genre($query->fetch());
        return $genre;
    }

}

?>