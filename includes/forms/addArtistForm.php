<?php
include 'includes/classes/GenreManager.class.php';
include_once 'includes/classes/Genre.class.php';

$gm = new GenreManager();
$genres = $gm->getListFetched();

?>

<div class="container">

    <form action="#" method="POST">

        <div class="row">

            <div class="col-md-4">
                <label>Nom</label>
                <input type="text" name="nom">
            </div>

            <div class="col-md-4">
                <label>Genre</label>
                <select name="genreId">
                <?php
                    foreach ($genres as $g) {
                        echo '<option value="' . $g['id'] . '">' . $g['nom'] . '</option>';
                    }
                    
                ?>
                </select>
            </div>

            <div class="col-md-4">
                <input type="submit" name="input" value="Enregistrer">
            </div>

        </div>

    </form>

</div>