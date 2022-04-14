var pop = document.querySelector(".popup")
var like = document.querySelector(".like_icon");
var monprofil = document.querySelector(".header_profilPic");
/*Cette fonction me permet d'avoir le second menue en hover lorsque la sourie passe sur une icone du header*/
/**
 * Element : designe l'icone qui prendra le hover
 * Pop : designe la div qui doit être afficher
 */
function popup(element, pop) {
    element.addEventListener("mouseenter", () => {
        console.log("toto")
        var popProfil = document.querySelector(".popupProfil")
        pop.style.cssText = "display:block;z-index : 8;opacity : 1";
        popProfil.style.cssText += "right : -100px;top : -10px";
        document.querySelector(".fixed").style.cssText = "z-index:-1"
    })
    element.addEventListener("mouseleave", () => {
        console.log("toto")
        pop.style.cssText = "display:none;z-index : -1";
        document.querySelector(".fixed").style.cssText = "z-index:8"
    })
}

/*Appel de la fonction*/
popup(like, document.querySelector(".popup"))
popup(monprofil, document.querySelector(".popup2"))