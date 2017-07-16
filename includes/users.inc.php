<?php  
include_once 'connexion_db.php';

// fonction d'affichage des utilisateurs
function getAllRoles() {
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
function getUserById($id) {
    // connexion à la BDD
    $db = connect();
    // requête
    $query = $db -> prepare('SELECT * FROM users WHERE id = :id');
    // exécution
    $query -> execute(array(
    ':id' => $id
    ));
    // renvoie un tableau associatif
    return $query -> fetch();
}

function addUser($user) {
    $db = connect();
    $query = $db -> prepare('
        INSERT INTO users (nom, prenom, email, password) VALUES (:nom, :prenom, :email, :password)
    ');
    $result = $query -> execute(array(
        ':nom'      => $user['nom'],
        ':prenom'   => $user['prenom'],
        ':email'    => $user['email_ins'],
        ':password' => $user['pass_ins']
    ));
    // boolean (vrai si succès, faux si échec)
    return $result;
}

function updateUser($user) {
    if(!isset($db)) $db = connect();

    $query = $db -> prepare('UPDATE users SET nom = :nom, prenom = :prenom, email = :email, password = :password, role = :role WHERE id = :id');

    $result = $query -> execute(array(        
        ':nom'      => $user['nom'],
        ':prenom'   => $user['prenom'],
        ':email'    => $user['email'],
        ':password' => $user['password'],
        ':role'     => $user['role'],
        ':id'       => $user['id']
    ));

    return $result;
}

?>