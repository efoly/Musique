<?php
    include_once 'includes/access.inc.php';
    include_once 'includes/header.php';

    $menus = [
        ['href' => 'index.php', 'label' => 'Accueil'],
    ];

    $menus_users = [
        ['href' => 'index.php', 'label' => 'Accueil'],
        ['href' => 'genres.php', 'label' => 'Genres']
    ];

    $menus_admins = [
        ['href' => 'index.php', 'label' => 'Accueil'],
        ['href' => 'genres.php', 'label' => 'Ecouter'],
        ['href' => 'artists.php', 'label' => 'Actualiser/Supprimer un artiste'],
        ['href' => 'addArtist.php', 'label' => 'Ajouter un artiste'],
        ['href' => 'manageAlbums.php', 'label' => 'Gérer les albums'],
        ['href' => 'manageTracks.php', 'label' => 'Gérer les titres'],
        ['href' => 'utilisateurs.php', 'label' => 'Gérer les utilisateurs']
    ];
    

?>

<nav>
    <ul>

        <?php
            if(!isLogged()) {

                foreach($menus as $menu) {
                    echo '<li><a href="' . $menu['href'] . '">' . $menu['label'] . '</a></li>';
                }

            } elseif (isLogged() && getRole() == 'admin') {
                // on a un administrateur, avec des droits supplémentaires
                foreach($menus_admins as $menu_admin) {
                    echo '<li><a href="' . $menu_admin['href'] . '">' . $menu_admin['label'] . '</a></li>';
                }

            } else {
                // on a affaire à un utilisateur classique
                foreach($menus_users as $menu_user) {
                    echo '<li><a href="' . $menu_user['href'] . '">' . $menu_user['label'] . '</a></li>';
                }

            }
        ?>

        <?php
        if(isLogged()) {
            echo '<li><a href="logout.php">Déconnexion</a></li>';
        }
        ?>

    </ul>
</nav>