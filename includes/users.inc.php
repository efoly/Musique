<?php  
include 'connexion_db.php';

// fonction d'affichage des utilisateurs
function getAllUsers() {
    // connexion à la BDD
    $db = connect();
    // requête
    $query = $db -> prepare('SELECT DISTINCT role FROM users');
    // exécution
    $query -> execute();
    // renvoie un tableau associatif
    return $query -> fetchAll();
}

// fonction d'affichage des utilisateurs
function getUserById() {
    // connexion à la BDD
    $db = connect();
    // requête
    $query = $db -> prepare('SELECT * FROM users WHERE id = :id');
    // exécution
    $query -> execute(array(
    ':id' => $id
    ));
    // renvoie un tableau associatif
    return $query -> fetchAll();
}

function addUser($user) {
    $db = connect();
    $query = $db -> prepare('
        INSERT INTO users (email, password) VALUES (:email, :password)
    ');
    $result = $query -> execute(array(
        ':email' =>     $user['email'],
        ':password' =>  $user['password']
    ));
    // boolean (vrai si succès, faux si échec)
    return $result;
}

?>