<?php
include 'includes/classes/AlbumManager.class.php';
include_once 'includes/classes/Album.class.php';
include 'includes/classes/TitreManager.class.php';
include_once 'includes/classes/Titre.class.php';

$albm = new AlbumManager();
$albs = $albm->getListFetched();

if(isset($_POST['input'])) {

    $condition = !empty($_POST['numero']) &&
                    !empty($_POST['libelle']) &&
                    !empty($_POST['chemin']) &&
                    !empty($_POST['albumId']) &&
                    !empty($_POST['prix']);

    if($condition) {

        $a = $_POST;

        $titre = new Titre($a);

            if ($titre->save()) {
                echo 'Titre enregistré avec succès en base de données !';
            } else {
                echo "Erreur lors de l'insertion du titre !";
            }

    } else {
        echo 'Veuillez remplir tous les champs svp.';
    }

} else {
    echo "Le client n'a pas validé le formulaire.";
}

// mise à jour d'un titre
if(isset($_POST['update'])) {

    $conditions =
                !empty($_POST['idTitre']) &&
                !empty($_POST['numTitre']) &&
                !empty($_POST['libTitre']) &&
                !empty($_POST['chemTitre']) &&
                !empty($_POST['albumId']) &&
                !empty($_POST['prixTitre']);
                

    if($conditions) {

        $id = $_POST['idTitre'];
        $numero = $_POST['numTitre'];
        $libelle = $_POST['libTitre'];
        $chemTitre = $_POST['chemTitre'];
        $albumId = $_POST['albumId'];
        $prix = $_POST['prixTitre'];

        $data = [
            'id'        => $id,
            'numero'    => $numero,
            'libelle'   => $libelle,
            'chemin'    => $chemTitre,
            'albumId'   => $albumId,
            'prix'      => $prix
        ];

        $t = new Titre($data); // instanciation d'un objet titre

        if($t->update()) {
            echo 'Mise à jour réussie !';
        } else {
            echo 'Echec de la mise à jour !';
        }
    }

} else {
    echo "<p>Le client n'a pas validé le formulaire de mise à jour.<p>";
}

// suppression d'un titre
if(isset($_POST['delete'])) {

    if(!empty($_POST['idTitre'])) {

        $id = $_POST['idTitre'];

        $tm = new TitreManager();
        $titre2 = $tm->getById($id); // renvoie le titre d'identifiant $id

        if($titre2->delete()) {
            echo 'Suppression du titre réussie !';
        } else {
            echo 'Echec de la suppression du titre !';
        }
    }
    
} else {
    echo "<p>Le client n'a pas validé le formulaire de suppression.<p>";
}

?>
<div ng-controller="artistCtrl">

    <h1>Ajouter un titre</h1>

    <div class="container">
        <form action="#" method="POST">

            <div class="row">

                <div class="col-md-2">
                    <label>Numéro</label>
                    <select name="numero">
                    <?php
                        for ($i=1; $i < 25; $i++) { 
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Libellé</label>
                    <input type="text" name="libelle">
                </div>

                <div class="col-md-2">
                    <label>Chemin</label>
                    <input type="text" name="chemin" value="morceaux/">
                </div>

                <div class="col-md-2">
                    <label>Album</label>
                    <select name="albumId">
                    <?php
                        foreach ($albs as $alb) {
                            echo '<option value="' . $alb['id'] . '">' . $alb['libelle'] . '</option>';
                        }
                        
                    ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Prix</label>
                    <input type="text" name="prix">
                </div>

                <div class="col-md-2">
                    <input type="submit" class="btn btn-primary btn-xs" name="input" value="Ajouter">
                </div>

            </div>

        </form>
    </div>

    <div ng-show="visibleTitre" class="well">
        
        <h1>Modifier/Supprimer un morceau</h1>
        <form action="#" method="POST">
            <input type="hidden" name="idTitre" value="{{idTit}}">
            
            <label>Numéro</label>
            <select ng-model="morceau.numero" name="numTitre">
                    <?php
                        for ($i=1; $i < 30; $i++) { 
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    ?>
            </select>

            <label>Libellé</label>
            <input ng-model="morceau.libelle" name="libTitre" type="text">

            <label>Chemin</label>
            <input type="text" ng-model="morceau.chemin" name="chemTitre" value="morceaux/">

            <label>Album</label>
            <select ng-model="morceau.albumId" name="albumId">
                <?php
                    foreach($albs as $a) {
                        echo '<option value="' . $a['id'] . '">' . $a['libelle'] . '</option>';
                    }
                ?>
            </select>

            <label>Prix</label>
            <input ng-model="morceau.prix" name="prixTitre" type="text">

            <input type="submit" class="btn btn-warning btn-xs" name="update" value="Actualiser">
            <input type="submit" class="btn btn-danger btn-xs" name="delete" value="Supprimer">
        </form>
    </div>

    <div>
        <h1>Liste des titres</h1>
        <table class="table table-striped">
            <tr>
                <th>Numéro</th>
                <th>Libellé</th>
                <th>Album</th>
                <th>Artiste</th>
                <th>Chemin</th>
                <th>Prix</th>
                <th>Action</th>
            </tr>

            <tr ng-repeat="titre in titres">
                <td>{{titre.numero}}</td>
                <td>{{titre.libelle}}</td>     
                <td>{{titre.albumLibelle}}</td>
                <td>{{titre.artisteNom}}</td>
                <td>{{titre.chemin}}</td>
                <td>{{titre.prix}}</td>
                <td>
                    <button ng-click="editTitre()" class="btn btn-success btn-xs">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                </td>
            </tr>
        </table>
    </div>



</div>