var app = angular.module('angularApp', []);

// Contrôleur pour afficher genres, artistes, albums et titres
app.controller('mainCtrl', function($scope, $http) {
    var selectedArtistName = null;
    var selectedAlbumName = null;

    $scope.visibleDiv = false;
    $scope.visibleAlb = false;
    $scope.visibleTracks = false;
    $scope.visibleAchat = false;

    function getGenres() {
        // requête ajax via le service $http
        var url = 'http://localhost/musique/ajaxGenres.php';
        $http.get(url).then(function(res) {
            $scope.genres = res.data;
        });
    }

    $scope.getArtists = function() {
        var grId = this.selectedGenre;

        if(!grId) {

            var url = 'http://localhost/musique/ajaxArtists.php';

        } else {
        
        var url = 'http://localhost/musique/ajaxArtists.php?id=' + grId;

        }

        // requête ajax via le service $http
        $http.get(url).then(function(res) {
            $scope.artistes = res.data;
        });
        
        $scope.visibleDiv = true;
    };
    
    $scope.getAlbums = function() {
        var artId = this.selectedArtist;
        
        if(!artId) {

            var url = 'http://localhost/musique/ajaxAlbums.php';

        } else {
        
        var url = 'http://localhost/musique/ajaxAlbums.php?id=' + artId;

        }

        // requête ajax via le service $http
        $http.get(url).then(function(res) {
            $scope.albums = res.data;
        });

        var selectArt = document.getElementById("art");

        // permet de récupérer le texte d'un select choisi
        selectedArtistName = selectArt.options[selectArt.selectedIndex].text;
        $scope.visibleAlb = true;     
    };
    
    $scope.getTracks = function() {
        var albId = this.selectedAlbum;
        var selectAlb = document.getElementById("alb");

        selectedAlbumName = selectAlb.options[selectAlb.selectedIndex].text;

        var conditions = selectedArtistName == "Tous les artistes" && 
                        selectedAlbumName == "Tous les albums";

        if(!albId || conditions) {

            var url = 'http://localhost/musique/ajaxTracks.php';

        } else {
        
        var url = 'http://localhost/musique/ajaxTracks.php?id=' + albId;

        }

        // requête ajax via le service $http
        $http.get(url).then(function(res) {
            $scope.tracks = res.data;
        });

        $scope.visibleTracks = true;
    };

    $scope.listen = function() {

        // Préréglage du volume (à la moitié => max: 1.0)
        var monElementAudio = document.querySelector('audio');
        monElementAudio.volume = 0.5;
        monElementAudio.src = this.t.chemin;
        monElementAudio.type = "audio/mpeg";

        $('#message').text('Vous avez choisi le titre "' + this.t.libelle + '", issu de l\'album ' + this.t.albumLibelle + ' de l\'artiste ' + this.t.artisteNom +' !');
    };

    $(document).on('change', 'th input#allPrices', function() {

        buyAll = $('th input#allPrices');
        buySingle = $('td input.singlePrice');

        if(buyAll.prop('checked')) {

            buySingle.prop('checked', true);

        } else {

            buySingle.prop('checked', false);

        }

    });

    $scope.sum = function() {

        var fact = document.querySelectorAll("table.pistes td.price");
        var calcul = 0;
        $scope.nbPistesChoisies = 0;

        fact.forEach(function(fac) {

            var f = $(fac);
            var input = f.next('td').children('input');
            var isChecked = input.prop('checked');

            if(isChecked) {

                calcul = calcul + fac.textContent * 1;
                $scope.nbPistesChoisies++;

            }

        });

        $scope.visibleAchat = true;
        // prix total arrondi à deux chiffres après la virgule
        document.querySelector("#total").value = calcul.toFixed(2) + ' €';
    }

    getGenres();


});

// Contrôleur pour gérer les artistes, albums et titres
app.controller('artistCtrl', function($scope, $http) {
$scope.visibleDiv2 = false;
$scope.visibleAlbum = false;
$scope.visibleTitre = false;

function getArtists() {
    var url = 'http://localhost/musique/ajaxArtists.php';

    // requête ajax via le service $http
    $http.get(url).then(function(res) {
        $scope.artists = res.data;
    });
}
 
$scope.editArtist = function() {
    $scope.art = this.a;
    $scope.idArt = this.a.id;
    
    getArtists();
    $scope.visibleDiv2 = true;
};

getArtists();

function getAlbums() {
    var url = 'http://localhost/musique/ajaxAlbums.php';

    // requête ajax via le service $http
    $http.get(url).then(function(res) {
        $scope.albums = res.data;
    });
}

$scope.editAlbum = function() {
    $scope.album = this.alb;
    $scope.idAlb = this.alb.id;
    
    getArtists();
    $scope.visibleAlbum = true;
};

getAlbums();

function getTitres() {
    var url = 'http://localhost/musique/ajaxTracks.php';

    // requête ajax via le service $http
    $http.get(url).then(function(res) {
        $scope.titres = res.data;
    });
}

$scope.editTitre = function() {
    $scope.morceau = this.titre;
    $scope.idTit = this.titre.id;
    
    getTitres();
    $scope.visibleTitre = true;
};

getTitres();
});