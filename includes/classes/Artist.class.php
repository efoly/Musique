<?php

class Artist
{
    public $db;

    public $id; // nécessaire pour les opérations de mise à jour et de suppression
    public $nom;
    public $genreId;

    function __construct($data)
    {
        // 1) connexion à la base de données
        $this->db = new PDO('mysql:host=localhost;dbname=musique', 'root', '');

        // si l'identifiant de l'artiste fait partie du tableau de données passé en entrée du constructeur, on l'utilise pour hydrater la propriété id de l'objet
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }

        $this->nom          = $data['nom'];
        $this->genreId      = $data['genreId'];
    }

    function save()
    {
        // 2) requête
        $query = $this->db->prepare('
            INSERT INTO artiste (nom, genreId) VALUES (:nom, :genreId)');

        // 3) execution
        return $query->execute(array(
            ':nom'          => $this->nom,
            ':genreId'      => $this->genreId
        ));
    }

    function update()
    {
        $query = $this->db->prepare('
            UPDATE artiste
            SET nom = :nom,
                genreId = :genreId
            WHERE id = :id
        ');

        return $query->execute(array(
            ':nom'          =>$this->nom,
            ':genreId'      =>$this->genreId,
            ':id'           =>$this->id
        ));
    }

    function delete() 
    {
        $query = $this->db->prepare('DELETE FROM artiste WHERE id = :id');
        
        return $query->execute(array(
            ':id' => $this->id
        ));
    }
}

?>