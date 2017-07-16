<?php
include 'includes/classes/ArtistManager.class.php';
include_once 'includes/classes/Artist.class.php';
include 'includes/classes/AlbumManager.class.php';
include_once 'includes/classes/Album.class.php';

$arm = new ArtistManager();
$artists = $arm->getListFetched();

if(isset($_POST['input'])) {
$a = $_POST;

$album = new Album($a);

    if ($album->save()) {
        echo 'Album enregistré avec succès en base de données !';
    } else {
        echo "Erreur lors de l'insertion de l'album !";
    }

} else {
    echo "Le client n'a pas validé le formulaire.";
}

// mise à jour d'un album
if(isset($_POST['update'])) {

    $conditions =
                !empty($_POST['libAlb']) &&
                !empty($_POST['anneeAlb']) &&
                !empty($_POST['artisteId']) &&
                !empty($_POST['idAlbum']);

    if($conditions) {

        $id = $_POST['idAlbum'];
        $libAlb = $_POST['libAlb'];
        $anneeAlb = $_POST['anneeAlb'];
        $artiste = $_POST['artisteId'];

        $data = [
            'libelle'   => $libAlb,
            'annee'     => $anneeAlb,
            'artisteId' => $artiste,
            'id'        => $id
        ];
        $al = new Album($data); // instanciation d'un objet album

        if($al->update()) {
            echo 'Mise à jour réussie !';
        } else {
            echo 'Echec de la mise à jour !';
        }
    }

} else {
    echo "<p>Le client n'a pas validé le formulaire de mise à jour.<p>";
}


// suppression d'un album
if(isset($_POST['delete'])) {

    if(!empty($_POST['idAlbum'])) {

        $id = $_POST['idAlbum'];

        $am = new AlbumManager();
        $album2 = $am->getById($id); // renvoie l'album d'identifiant $id

        if($album2->delete()) {
            echo 'Suppression réussie !';
        } else {
            echo 'Echec de la suppression !';
        }
    }
    
} else {
    echo "<p>Le client n'a pas validé le formulaire de suppression.<p>";
}

?>
<div ng-controller="artistCtrl">

    <h1>Enregistrer un album</h1>

    <div class="container">
        <form action="#" method="POST">

            <div class="row">

                <div class="col-md-3">
                    <label>Libelle</label>
                    <input type="text" name="libelle">
                </div>

                <div class="col-md-3">
                    <label>Annee</label>
                    <select name="annee">
                    <?php
                        for ($i=1990; $i < 2018; $i++) { 
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Artiste</label>
                    <select name="artisteId">
                    <?php
                        foreach ($artists as $art) {
                            echo '<option value="' . $art['id'] . '">' . $art['nom'] . '</option>';
                        }
                        
                    ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary btn-xs" name="input" value="Ajouter">
                </div>

            </div>

        </form>
    </div>

    <div ng-show="visibleAlbum" class="well">
        
        <h1>Modifier/Supprimer un album</h1>
        <form action="#" method="POST">
            <input type="hidden" name="idAlbum" value="{{idAlb}}">
        
            <label>Libellé</label>
            <input ng-model="album.libelle" name="libAlb" type="text">

            <label>Année</label>
            <select ng-model="album.annee" name="anneeAlb">
                <?php
                    for ($i=1990; $i < 2018; $i++) { 
                        echo '<option value="' . $i . '">' . $i . '</option>';                    
                    }
                ?>
            </select>

            <label>Artiste</label>
            <select ng-model="album.artisteId" name="artisteId">
                <?php
                    foreach($artists as $artist) {
                        echo '<option value="' . $artist['id'] . '">' . $artist['nom'] . '</option>';
                    }
                ?>
            </select>
            <input type="submit" class="btn btn-warning btn-xs" name="update" value="Actualiser">
            <input type="submit" class="btn btn-danger btn-xs" name="delete" value="Supprimer">
        </form>
    </div>

    <div>
        <h1>Liste des albums</h1>
        <table class="table table-striped">
            <tr>
                <th>Nom</th>
                <th>Année</th>
                <th>Action</th>
            </tr>

            <tr ng-repeat="alb in albums">
                <td>{{alb.libelle}}</td>
                <td>{{alb.annee}}</td>
                <td>
                    <button ng-click="editAlbum()" class="btn btn-success btn-xs">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                </td>
            </tr>
        </table>
    </div>



</div>