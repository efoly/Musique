//*** Variables globales ***

var users = null;

// **********************************************************

//*** Fonctions ***
function getUsers() {
    var url = 'http://localhost/Musique/ajaxUsers.php';

    $.get(url, function(data) {
        users = JSON.parse(data);
        displayTable(users);
    });
}

function displayTable(users) {

    var table = '<table class="table table-striped">';

    // entête
    table += "<tr><th>Nom</th><th>Prénom</th><th>Email</th><th>Password</th><th>Role</th><th>Modifier</th><th>Supprimer</th></tr>";
    
    // boucle
    users.forEach(function(user) {

        table += '<tr>';
        table += '<td>' + user.nom + '</td>';
        table += '<td>' + user.prenom + '</td>';
        table += '<td>' + user.email + '</td>';
        table += '<td>' + user.password + '</td>';
        table += '<td>' + user.role + '</td>';
        table += '<td><a href="updateUser.php?id=' + user.id + '"><button class="btn btn-success btn-xs">Modifier !</button></a></td>';
        table += '<td><a href="deleteUser.php?id=' + user.id + '"><button class="btn btn-danger btn-xs">Supprimer !</button></a></td>';
        table += '</tr>';

    });

    table += '</table>';
    $('#listUsers').html(table);
}

function hideUsers(rolefiltre) {
    var rows = $('table tr'); // on récupère les lignes du tableau

    $.each(rows, function(index, row) {
        // on cible la ligne par zepto afin "d'envelopper" l'élément 
        // de nouvelles capacités (proppriétés et méthodes)
        var r = $(row); // r est "plus riche" en fonctionnalités que row

        var role = r.children().eq(4).text();
        
        if(role != rolefiltre && index != 0) {

            r.hide();

        } else {
            
            r.show();
            
        }
    });
}

getUsers(); // appel de la fonction au chargement du script
// **********************************************************

//*** Ecouteurs d'événement (eventListeners) ***
$(document).on('change', '#filterRoles', function() {
    filterRole = $(this).val(); // val() récupère la valeur de l'élément de formulaire (select)
    hideUsers(filterRole);
});

