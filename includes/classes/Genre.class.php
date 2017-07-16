<?php

class Genre
{
    public $db;

    public $id; // nécessaire pour les opérations de mise à jour et de suppression
    public $nom;

    function __construct($data)
    {
        // 1) connexion à la base de données
        $this->db = new PDO('mysql:host=localhost;dbname=musique', 'root', '');

        // si l'identifiant du genre fait partie du tableau de données passé en entrée du constructeur, on l'utilise pour hydrateur la propriété id de l'objet
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }

        $this->nom = $data['nom'];
    }

    function save()
    {
        // 2) requête
        $query = $this->db->prepare('INSERT INTO genre (nom) VALUES (:nom)');

        // 3) execution
        return $query->execute(array(
            ':nom' => $this->nom
        ));
    }

    function update()
    {
        $query = $this->db->prepare('
            UPDATE genre
            SET nom = :nom
            WHERE id = :id
        ');

        return $query->execute(array(
            ':nom'          =>$this->nom,
            ':id'           =>$this->id
        ));
    }

    function delete() 
    {
        $query = $this->db->prepare('DELETE FROM genre WHERE id = :id');
        
        return $query->execute(array(
            ':id' => $this->id
        ));
    }
}

?>