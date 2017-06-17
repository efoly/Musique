<?php
include 'includes/connexion_db.php';
include 'includes/header.php';
include 'includes/menu.php';

if(isset($_POST['email_cnx']) && isset($_POST['pass_cnx'])) {

    $email = $_POST['email_cnx'];
    $pass = $_POST['pass_cnx'];

    // connexion à mysql, requête et exécution
    $db = connect();
    $query = $db -> prepare('SELECT * FROM users WHERE email = :email AND password = :password');
    $query -> execute(array(
        ':email' =>         $email,
        ':password' =>      $pass
    ));

    $result = $query -> fetch();

    // si l'utilisateur est recensé dans la base de données
    if($result) {
        $_SESSION['user'] = $result;
        // redirection vers la page des genres musicaux disponibles
        header('location:genres.php');

    // sinon
    } else {
        // message d'erreur
        echop('Utilisateur non reconnu');
    }

} else {
    // accès par GET
    echop('Formulaire non validé');
}

?>

<?php include 'includes/footer.php' ?>