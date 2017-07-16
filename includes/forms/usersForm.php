<?php
include 'includes/users.inc.php';
$choices = getAllRoles();
?>

<h1>Liste des Utilisateurs par rôle</h1>

<div ng-controller="mainCtrl">

    <form>
        <label>Filtrer par rôle :</label>
        <select id="filterRoles">
            <?php
                foreach($choices as $choice){
                    echo '<option>' . $choice['role'] . '</option>';
                }
            ?>
        </select>
    </form>

    <div id="listUsers"></div>

</div>