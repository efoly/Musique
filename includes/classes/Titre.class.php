<?php

class Titre
{
    public $db;

    public $id; // nécessaire pour les opérations de mise à jour et de suppression
    public $numero;
    public $libelle;
    public $chemin;
    public $albumId;
    public $prix;

    function __construct($data)
    {
        // 1) connexion à la base de données
        $this->db = new PDO('mysql:host=localhost;dbname=musique', 'root', '');

        // si l'identifiant de l'album fait partie du tableau de données passé en entrée du constructeur, on l'utilise pour hydrater la propriété id de l'objet
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }

        $this->numero      = $data['numero'];
        $this->libelle     = $data['libelle'];
        $this->chemin      = $data['chemin'];
        $this->albumId     = $data['albumId'];
        $this->prix        = $data['prix'];
    }

    function save()
    {
        // 2) requête
        $query = $this->db->prepare('
            INSERT INTO titre (numero, libelle, chemin, albumId, prix) VALUES (:numero, :libelle, :chemin, :albumId, :prix)');

        // 3) execution
        return $query->execute(array(
            ':numero'      =>$this->numero,
            ':libelle'     =>$this->libelle,
            ':chemin'      =>$this->chemin,
            ':albumId'     =>$this->albumId,
            ':prix'        =>$this->prix
        ));
    }

    function update()
    {
        $query = $this->db->prepare('
            UPDATE titre
            SET numero = :numero,
                libelle = :libelle,
                chemin = :chemin,
                albumId = :albumId,
                prix = :prix
            WHERE id = :id
        ');

        return $query->execute(array(
            ':numero'       =>$this->numero,
            ':libelle'      =>$this->libelle,
            ':chemin'       =>$this->chemin,
            ':albumId'      =>$this->albumId,
            ':prix'         =>$this->prix,
            ':id'           =>$this->id
        ));
    }

    function delete() 
    {
        $query = $this->db->prepare('DELETE FROM titre WHERE id = :id');
        
        return $query->execute(array(
            ':id' => $this->id
        ));
    }
}

?>