<?php
include 'includes/users.inc.php';
include_once 'includes/connexion_db.php';
include 'includes/header.php';
include 'includes/menu.php';

if(isset($_POST['btn_ins'])) {

    $mailInsOk = $_POST['email_ins'];

    $conditions = isset($_POST['email_ins']) && 
                    isset($_POST['pass_ins']);

    if(filter_var($mailInsOk, FILTER_VALIDATE_EMAIL)) {

        if($conditions) {

            $email = $_POST['email_ins'];
            $pass = $_POST['pass_ins'];

            // connexion à mysql, requête et exécution
            $db = connect();
            $query = $db -> prepare('SELECT * FROM users WHERE email = :email AND password = :password');
            $query -> execute(array(
                ':email'    =>$email,
                ':password' =>$pass
            ));

            $result = $query -> fetch();

            // si l'utilisateur est déjà recensé dans la base de données
            if($result) {

                echo "Veuillez choisir un autre email, ainsi qu'un autre mot de passe pour vous inscrire svp.";

            } else {

                $infosIns = $_POST;

                if(addUser($infosIns)) {

                    echo 'Inscription réussie, vous pouvez désormais vous connecter !';

                } else {

                    echo "Echec lors de l'insertion !";

                }

            }

        } else {

            echo "Veuillez remplir correctement tous les champs marqués d'un astérisque(*) pour vous inscrire svp.";

        }

    } else {

        echo 'Veuillez saisir un mail et un mot de passe corrects svp.';

    }

} else {
        // tentative d'accès par GET
        echo "<p>Formulaire d'inscription non validé !<p>";
}


if(isset($_POST['btn_cnx'])) {

    $conditions2 = isset($_POST['email_cnx']) && 
                    isset($_POST['pass_cnx']);

    if($conditions2) {

        $email = $_POST['email_cnx'];
        $pass = $_POST['pass_cnx'];

        // connexion à mysql, requête et exécution
        $db = connect();
        $query = $db -> prepare('SELECT * FROM users WHERE email = :email AND password = :password');
        $query -> execute(array(
            ':email'    =>$email,
            ':password' =>$pass
        ));

        $result2 = $query -> fetch();

        // si l'utilisateur est recensé dans la base de données
        if($result2) {
            $_SESSION['user'] = $result2;
            // redirection vers la page des genres musicaux disponibles
            header('location:genres.php');

        // sinon
        } else {
            // message d'erreur
            echo '<p>Utilisateur non reconnu !</p>';
        }

    } else {
        // accès par GET
        echo '<p>Formulaire de connexion non validé !<p>';
    }
}

?>

<?php include 'includes/footer.php' ?>