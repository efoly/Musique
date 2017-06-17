<?php   
include_once 'includes/access.inc.php';
include 'includes/header.php';
include 'includes/menu.php';
?>

<?php
if(isLogged()) {
    echo '<p>Bienvenue ' . getAccount() . ' !</p>';
} else {
    echo 'Veuillez vous connecter pour accéder à cette page';
}
?>

<br><br>
<div class="banner">

        <div class="banner-element">

            <div class="banner-element-img"> 
                <img src="images/banniere/indie.jpg" alt="Erreur d'image">
            </div>

            <div class="banner-element-lien">
                <a href="#">Indépendant</a>
            </div>

        </div>

        <div class="banner-element">

            <div class="banner-element-img">
                <img src="images/banniere/rap.jpg" alt="Erreur d'image">
            </div>

            <div class="banner-element-lien">
                <a href="#">Rap</a>
            </div>

        </div>

        <div class="banner-element">

            <div class="banner-element-img"> 
                <img src="images/banniere/pop.jpg" alt="Erreur d'image">
            </div>

            <div class="banner-element-lien">
                <a href="#">Pop</a>
            </div>

        </div>

        <div class="banner-element">
            <div class="banner-element-img"> 
                <img src="images/banniere/rock.jpg" alt="Erreur d'image">
            </div>
            <div class="banner-element-lien">
                <a href="#">Rock</a>
            </div>
        </div>

        <div class="banner-element">

            <div class="banner-element-img"> 
                <img src="images/banniere/electro.jpg" alt="Erreur d'image">
            </div>

            <div class="banner-element-lien">
                <a href="#">Electro</a>
            </div>

        </div>

</div>

<?php include 'includes/footer.php'; ?>