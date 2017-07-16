<div align="center" ng-controller="mainCtrl">

    <div>
        <label>Choisissez votre genre de musique:</label>
        <select ng-model="selectedGenre">
            <option value="">Tous les genres</option>
            <option ng-repeat="g in genres" value="{{g.id}}">{{g.nom}}</option>
        </select>
        
        <button ng-click="getArtists()" class="btn btn-primary btn-xs">Choisir le genre</button>
    </div>

    <div ng-show="visibleDiv">
        <label>Choisissez votre artiste:</label>
        <select ng-model="selectedArtist" id="art">
            <option value="">Tous les artistes</option>
            <option ng-repeat="a in artistes" value="{{a.id}}">{{a.nom}}</option>
        </select>
        
        <button ng-click="getAlbums()" class="btn btn-primary btn-xs">Choisir l'artiste</button>
    </div>

    <div ng-show="visibleAlb">
        <label>Choisissez votre album:</label>
        <select ng-model="selectedAlbum" id="alb">
            <option value="">Tous les albums</option>
            <option ng-repeat="album in albums" value="{{album.id}}">{{album.libelle}}</option>
        </select>

        <button ng-click="getTracks()" class="btn btn-primary btn-xs">Choisir l'album</button>
    </div>

    <div ng-show="visibleTracks">

        <br><br>
        
        <label>Recherche</label>
        <input ng-model="search" type="text" placeholder="Recherche">

        <br><br>

        <p><strong id="message"></strong></p>
        <!-- nodownload : pas de téléchargement possible -->
        <audio controls controlsList="nodownload" preload="none"></audio>   

        <br>
        <!-- tableau avec surlignement de ligne au passage de la souris, 
        et avec des bordures pour le tableau et les cellules (Bootstrap) -->
        <table class="table table-hover table-bordered pistes">
            <tr>
                <th>Numéro</th>
                <th>Libellé</th>
                <th>Album</th>
                <th>Artiste</th>
                <th>Genre</th>
                <th>Ecouter</th>
                <th>Prix (en €)</th>
                <th>Acheter <input type="checkbox" id="allPrices"></th>
            </tr>
            <tr ng-repeat="t in filteredTracks=(tracks | filter:search)">
                <td>{{t.numero}}</td>
                <td>{{t.libelle}}</td>
                <td>{{t.albumLibelle}}</td>
                <td>{{t.artisteNom}}</td>
                <td>{{t.genreNom}}</td>
                <td>
                    <button ng-click="listen()" class="btn btn-success btn-xs">
                        <span class="glyphicon glyphicon-play"></span>
                    </button>
                </td>
                <td class="price">{{t.prix}}</td>
                <td><input type="checkbox" class="singlePrice"></td>
            </tr>
        </table>

        <p ng-show="visibleAchat"><strong id="nbPistes">Nombre de titres achetés: {{nbPistesChoisies}} / {{filteredTracks.length}}</strong></p>

        <label>Total à payer</label>
        <input type="text" id="total">
        <button ng-click="sum()">Calculer !</button>

    </div>

</div>
