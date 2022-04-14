
document.forms["connexion"].addEventListener("submit", function (e) {
    var paragrapheErreur = document.getElementById("erreur");
    var erreur;

    var inputs = this;

    // Traitement générique
    for (var i = 0; i < inputs.length; i++) {
        console.log(inputs[i]);

        if (!inputs[i].value) {
            inputs[i].style.borderBottom = "2px solid #ff000057";
            paragrapheErreur.className = "alert alert-danger";
            erreur = "Veuillez renseigner tous les champs";

        }
    }

    if (erreur) {

        e.preventDefault();
        document.getElementById("erreur").innerHTML = erreur;
        return false;
    } else {


    }
});



/* VERIFICATION DE LA TAILLE MAX ET MIN DU NOM,PRENOM,EMAIL,NUMERO,ADRESSE*/
/*NOM VERIF*/
document.getElementById("mdp1").addEventListener("blur", function () {
    var paragrapheErreur = document.getElementById("erreur");

    if ((this.value).length < 8 ) {
        paragrapheErreur.className = "alert alert-danger";
        paragrapheErreur.innerHTML = "Mot de passe trop cours";
        this.style.borderBottom = "2px solid  red";

    } else {
        paragrapheErreur.className = " ";
        paragrapheErreur.innerHTML = "";
        this.style.borderBottom = "2px solid  #31bd52";

    }

});
document.getElementById("mdp1").addEventListener("focus", function () {
    var paragrapheErreur = document.getElementById("erreur");

    if ((this.value).length < 8 ) {
       
        paragrapheErreur.className = " ";
        paragrapheErreur.innerHTML = "";
        this.style.borderBottom = "2px solid  #31bd52";

    }

});


function checkEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validate(email) {


    if (checkEmail(email)) {
        return true;
    } else {
        return false;
    }

}
/*ADRESSE VERIF */
document.getElementById("email").addEventListener("blur", function (e) {
    var paragrapheErreur = document.getElementById("erreur");
    console.log(validate(this.value))

    if (!validate(this.value) || this.value.length < 8) {
        paragrapheErreur.className = "alert alert-danger";
        paragrapheErreur.innerHTML = "l'email entré est incorrect";
        this.style.borderBottom = "2px solid  red";
    } else {
        paragrapheErreur.className = " ";
        paragrapheErreur.innerHTML = "";
        this.style.borderBottom = "2px solid  #31bd52";

    }

})

document.getElementById("email").addEventListener("focus", function (e) {
    var paragrapheErreur = document.getElementById("erreur");
    console.log(validate(this.value))

    
        paragrapheErreur.className = " ";
        paragrapheErreur.innerHTML = "";
        this.style.borderBottom = "2px solid  #31bd52";

    

});