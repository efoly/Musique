<?php
include 'includes/classes/ArtistManager.class.php';
include_once 'includes/classes/Artist.class.php';
include 'includes/classes/GenreManager.class.php';
include_once 'includes/classes/Genre.class.php';

$gm = new GenreManager();
$gr = $gm->getListFetched();

// mise à jour d'un artiste
if(isset($_POST['update'])) {

    $conditions =
                !empty($_POST['nomArt']) &&
                !empty($_POST['genreId']) &&
                !empty($_POST['idArtist']);

    if($conditions) {

        $id = $_POST['idArtist'];
        $nomArt = $_POST['nomArt'];
        $genre = $_POST['genreId'];

        $data = [
            'nom'       => $nomArt,
            'genreId'   => $genre,
            'id'        => $id
        ];
        $artist = new Artist($data); // instanciation d'un objet artiste

        if($artist->update()) {
            echo 'Mise à jour réussie !';
        } else {
            echo 'Echec de la mise à jour !';
        }
    }

} else {
    echo "<p>Le client n'a pas validé le formulaire de mise à jour.<p>";
}


// suppression d'un artiste
if(isset($_POST['delete'])) {

    if(!empty($_POST['idArtist'])) {

        $id = $_POST['idArtist'];

        $am = new ArtistManager();
        $artist2 = $am->getById($id); // renvoie l'artiste d'identifiant $id

        if($artist2->delete()) {
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

    <div ng-show="visibleDiv2" class="well">
        
        <form action="#" method="POST">
            <input type="hidden" name="idArtist" value="{{idArt}}">
        
            <label>Nom</label>
            <input ng-model="art.nom" name="nomArt" type="text">
            <label>Genre</label>
            <select ng-model="art.genreId" name="genreId">
                <?php
                    foreach($gr as $g) {
                        echo '<option value="' . $g['id'] . '">' . $g['nom'] . '</option>';
                    }
                ?>
            </select>
            <input type="submit" class="btn btn-warning btn-xs" name="update" value="Actualiser">
            <input type="submit" class="btn btn-danger btn-xs" name="delete" value="Supprimer">
        </form>
    </div>
    <table class="table table-striped">
        <tr>
            <th>Nom</th>
            <th>Actions</th>
        </tr>

        <tr ng-repeat="a in artists">
            <td>{{a.nom}}</td>
            <td>
                <button ng-click="editArtist()" class="btn btn-success btn-xs">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
            </td>
        </tr>
    </table>
</div>