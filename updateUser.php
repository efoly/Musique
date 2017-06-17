<?php

include_once 'includes/users.inc.php';
include 'includes/header.php';
include 'includes/menu.php';

// récupération de l'id de l'utilisateur
if(isset($_GET['id'])) {

    $id = $_GET['id'];
    $utilisateurs = getUsersById($id);
}

// mise à jour de la table users
if(isset($_POST['update'])){
    // le bouton de "mise à jour" a été cliqué
    // si la connexion n'existe pas, on DOIT l'initialiser avant l'étape de requête
    if(!isset($db)) $db = connect();
        
    $query = $db -> prepare('UPDATE users SET email = :email, password = :password, role = :role WHERE id = :id');
    $query -> execute(array(
    ':email' =>            $_POST['email'],
    ':password' =>         $_POST['password'],
    ':role' =>             $_POST['role'],
    ':id' =>               $id
    ));
    
    // redirection vers la liste des utilisateurs
    header('location:utilisateurs.php');
}

?>

<h1>Modifier un utilisateur</h1>

<form method="POST">

    <label>Email</label>
    <input type="text" name="email" value="<?php echo $utilisateurs['email']; ?>">
    
    <label>Password</label>
    <input type="text" name="password" value="<?php echo $utilisateurs['password']; ?>">
    
    <label>Rôle</label>
    <input type="text" name="role" value="<?php echo $utilisateurs['role']; ?>">
    <br>

    <!-- cet input caché ("hidden") permet de récupérer $id(ou $_GET['id']) en POST -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <input class="btn btn-primary btn-xs" type="submit" name="update" value="Mettre à jour">

</form>


<?php include 'includes/footer.php'; ?>