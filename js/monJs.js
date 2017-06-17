// Fonction visant à faire disparaître le formulaire non sélectionné
$(document).on('change', '#check_ins', function() {
    var inscription = $('input#check_ins');

    if(!inscription.prop('checked')) {
       
        $('table.ins').hide();

    } else {

        $('table.ins').show();
        $('table.cnx').hide();

    }
});

$(document).on('change', '#check_cnx', function() {
    var identification = $('input#check_cnx');
    
    if(!identification.prop('checked')) {

        $('table.cnx').hide();

    } else {

        $('table.cnx').show();
        $('table.ins').hide();

    }
});


// Fonction vidant le formulaire d'identification
function vider_cnx() {

    // si le formulaire d'inscription est en cours de remplissage
    if(document.getElementsByTagName("email_ins").value != "" || document.getElementsByTagName("pass_ins").value != "") {
        
        // alors, on vide le formulaire d'identification
        document.forms["form_connexion"].reset();
    }

    return true;
};

// Fonction vidant le formulaire d'inscription
function vider_ins() {

    // si le formulaire d'identification est en cours de remplissage
    if(document.getElementsByTagName("email_cnx").value != "" || document.getElementsByTagName("pass_cnx").value != ""){

        // alors, on vide le formulaire d'inscription
        document.forms["form_inscription"].reset();
    }
	
    return true;
};