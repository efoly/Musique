<?php  
    include 'includes/users.inc.php';
    include 'includes/header.php';
    include 'includes/menu.php';

    $choices = getAllUsers();
?>

<h1>Liste des Utilisateurs par rôle</h1>

<div>
    <form method="POST">
        <label>Rôle</label>
        <select id="filterRoles">
            <?php
                foreach($choices as $choice){
                    echo '<option>' . $choice['role'] . '</option>';
                }
            ?>
        </select>
    </form>
</div>

<div id="listUsers"></div>

<?php include 'includes/footer.php'; ?>