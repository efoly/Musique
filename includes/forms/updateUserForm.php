<?php
include 'includes/users.inc.php';

$rs = getAllRoles();

// récupération de l'id de l'utilisateur
if(isset($_GET['id'])) {

    $id = $_GET['id'];
    $utilisateurs = getUserById($id);
}

// mise à jour de la table users
if(isset($_POST['updateUser'])) {
    $maj = [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'role' => $_POST['role'],
        'id' => $id
    ];

    if(updateUser($maj)) {

        // redirection vers la liste des utilisateurs
        header('location:utilisateurs.php');

    } else {

        echo 'Erreur lors de la mise à jour !';

    }
}

?>

<h1>Modifier un utilisateur</h1>

<form action="#" method="POST">

    <label>Nom</label>
    <input type="text" name="nom" value="<?php echo $utilisateurs['nom']; ?>">

    <label>Prénom</label>
    <input type="text" name="prenom" value="<?php echo $utilisateurs['prenom']; ?>">

    <label>Email</label>
    <input type="text" name="email" value="<?php echo $utilisateurs['email']; ?>">
    
    <label>Password</label>
    <input type="text" name="password" value="<?php echo $utilisateurs['password']; ?>">
    
    <label>Rôle</label>
    <select name="role">
        <?php
            foreach ($rs as $r) {
                if($r['role'] == $utilisateurs['role']) {

                    echo '<option selected="' . $utilisateurs['role'] . '">' . $r['role'] . '</option>';

                } else {

                    echo '<option value="' . $r['role'] . '">' . $r['role'] . '</option>';

                }
            }
        ?>
    </select>

    <input class="btn btn-primary btn-xs" type="submit" name="updateUser" value="Mettre à jour">
    
</form>