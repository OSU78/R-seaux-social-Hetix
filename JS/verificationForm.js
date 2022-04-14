
document.forms["inscription"].addEventListener("submit", function (e) {
    var paragrapheErreur = document.getElementById("erreur");
    var erreur;

    var inputs = this;

    // Traitement générique
    for (var i = 0; i < inputs.length; i++) {
        console.log(inputs[i]);

        if (!inputs[i].value || inputs[i].value.length<4) {
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



/* VERIFICATION DE LA COHERENCE DES DEUX MDP*/
document.getElementById("mdp2").addEventListener("input", function () {
    var paragrapheErreur = document.getElementById("erreur");

    if (this.value != document.getElementById("mdp1").value) {

        paragrapheErreur.className = "alert alert-danger";
        paragrapheErreur.innerHTML = "Les deux mot de passe ne correspondent pas";
        this.style.borderBottom = "2px solid  red";
        document.getElementById("mdp1").setCustomValidity("Les deux mot de passe ne correspondent pas");

    } else {
        this.style.borderBottom = "2px solid  #31bd52";
        document.getElementById("mdp1").style.borderBottom = "2px solid  #31bd52";
        paragrapheErreur.className = "alert";
        paragrapheErreur.innerHTML = "";
        document.getElementById("mdp1").setCustomValidity("");
        if ((this.value).length < 8 && (document.getElementById("mdp1").value).length < 8) {
            paragrapheErreur.className = "alert alert-danger";
            paragrapheErreur.innerHTML = "le mot de passe doit contenir au moins 8 caractères";
            this.style.borderBottom = "2px solid  red";
            document.getElementById("mdp1").style.borderBottom = "2px solid  red";
        } else {
            paragrapheErreur.className = " ";
            paragrapheErreur.innerHTML = "";
            this.style.borderBottom = "2px solid  #31bd52";
            document.getElementById("mdp1").style.borderBottom = "2px solid  #31bd52";
        }
    }

})
/* *********************************** */

/* VERIFICATION DE LA TAILLE MAX ET MIN DU NOM,PRENOM,EMAIL,NUMERO,ADRESSE*/
/*NOM VERIF*/
document.getElementById("nom").addEventListener("input", function () {
    var paragrapheErreur = document.getElementById("erreur");

    if ((this.value).length < 4 || (this.value).length > 40) {
        paragrapheErreur.className = "alert alert-danger";
        paragrapheErreur.innerHTML = "le nom doit contenir au moins 4 caractères";
        this.style.borderBottom = "2px solid  red";

    } else {
        paragrapheErreur.className = " ";
        paragrapheErreur.innerHTML = "";
        this.style.borderBottom = "2px solid  #31bd52";

    }

});

/*PRENOM VERIF*/
document.getElementById("prenom").addEventListener("input", function () {
    var paragrapheErreur = document.getElementById("erreur");

    if ((this.value).length < 4 || (this.value).length > 40) {
        paragrapheErreur.className = "alert alert-danger";
        paragrapheErreur.innerHTML = "le prenom doit contenir au moins 4 caractères";
        this.style.borderBottom = "2px solid  red";

    } else {
        paragrapheErreur.className = " ";
        paragrapheErreur.innerHTML = "";
        this.style.borderBottom = "2px solid  #31bd52";

    }

});

/*Pseudo VERIF*/
document.getElementById("pseudo").addEventListener("input", function () {
    var paragrapheErreur = document.getElementById("erreur");

    if ((this.value).length < 4 || (this.value).length > 40) {
        paragrapheErreur.className = "alert alert-danger";
        paragrapheErreur.innerHTML = "le pseudo doit contenir au moins 4 caractères";
        this.style.borderBottom = "2px solid  red";

    } else {
        paragrapheErreur.className = " ";
        paragrapheErreur.innerHTML = "";
        this.style.borderBottom = "2px solid  #31bd52";

    }

});


/* CODE POSTAL VERIF */
/*
document.getElementById("code_postal").addEventListener("input", function() {
	var paragrapheErreur = document.getElementById("erreur");

	if ((this.value).length < 5 || (this.value).length>5) {
		paragrapheErreur.className="alert alert-danger";
		paragrapheErreur.innerHTML = "le code Postal doit est limiter à 5 caractères";
		this.style.borderBottom="2px solid  red";

	} else {
		paragrapheErreur.className="alert";
		paragrapheErreur.innerHTML = "";
		this.style.borderBottom="2px solid  #31bd52";

	}

});
*/

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
document.getElementById("email").addEventListener("input", function (e) {
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

});
/*NUMERO VERIF */
/*
document.getElementById("contact").addEventListener("input", function() {
	var paragrapheErreur = document.getElementById("erreur");

	if ((this.value).length < 10 || (this.value).length>10 ) {
		paragrapheErreur.className="alert alert-danger";
		paragrapheErreur.innerHTML = "la saisie du numero est limiter à 10 chiffres";
		this.style.borderBottom="2px solid  red";


	} else {
		paragrapheErreur.className="alert";
		paragrapheErreur.innerHTML = "";
		this.style.borderBottom="2px solid  #31bd52";

	}


});

*/