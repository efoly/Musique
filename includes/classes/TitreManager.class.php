<?php
include 'Titre.class.php';

class TitreManager
{
    public $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=musique', 'root', '');

    }

    function getListFetched()
    {
        $query = $this->db->prepare('SELECT titre.id, titre.numero, titre.libelle, titre.chemin, titre.albumId, titre.prix FROM titre');
        $query->execute();
        return $query->fetchAll(); // renvoie un tableau associatif
    }

    function getById($id)
    {
        $query = $this->db->prepare('SELECT * FROM titre WHERE titre.id = :id');
        $query->execute(array(
            ':id' => $id
        ));

        $titre = new Titre($query->fetch());
        return $titre;
    }

}

?>