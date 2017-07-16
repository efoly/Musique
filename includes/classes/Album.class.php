<?php

class Album
{
    public $db;

    public $id; // nécessaire pour les opérations de mise à jour et de suppression
    public $libelle;
    public $annee;
    public $artisteId;

    function __construct($data)
    {
        // 1) connexion à la base de données
        $this->db = new PDO('mysql:host=localhost;dbname=musique', 'root', '');

        // si l'identifiant de l'album fait partie du tableau de données passé en entrée du constructeur, on l'utilise pour hydrater la propriété id de l'objet
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }

        $this->libelle      = $data['libelle'];
        $this->annee        = $data['annee'];
        $this->artisteId    = $data['artisteId'];
    }

    function save()
    {
        // 2) requête
        $query = $this->db->prepare('
            INSERT INTO album (libelle, annee, artisteId) VALUES (:libelle, :annee, :artisteId)');

        // 3) execution
        return $query->execute(array(
            ':libelle'    => $this->libelle,
            ':annee'      => $this->annee,
            ':artisteId'  => $this->artisteId
        ));
    }

    function update()
    {
        $query = $this->db->prepare('
            UPDATE album
            SET libelle = :libelle,
                annee = :annee,
                artisteId = :artisteId
            WHERE id = :id
        ');

        return $query->execute(array(
            ':libelle'      =>$this->libelle,
            ':annee'        =>$this->annee,
            ':artisteId'    =>$this->artisteId,
            ':id'           =>$this->id
        ));
    }

    function delete() 
    {
        $query = $this->db->prepare('DELETE FROM album WHERE id = :id');
        
        return $query->execute(array(
            ':id' => $this->id
        ));
    }
}

?>