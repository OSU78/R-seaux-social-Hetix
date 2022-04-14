window.setTimeout(() => {
    let followBtn = document.querySelectorAll(".follow")
    for (let i = 0; i < followBtn.length; i++) {
        if (followBtn[i]) {
            followBtn[i].addEventListener("click", (e) => {
                let idUserFollow = followBtn[i].attributes[2].value;
                e.preventDefault();
                var location = (window.location.href.split("?")[0]).split("/")
                var locationArraySize = location.length - 1
                if (location[locationArraySize] == "profil.php") {
                    e.target.innerText = "ecrire";
                    var anim = document.querySelector(".animFollowAppear")
                    anim.style.cssText = "Background-color: white; width: -webkit-fill-available;height: 15px;transition : 0.4s;min-width:60px"
                    anim.innerHTML = '  <lottie-player id="lottie2" src="ASSETS/icones/addFollow.json" background="transparent" speed="0.8" style="width: 28px; height: 28px;" autoplay></lottie-player>';
                } else {
                    e.target.style.display = "none";
                }

                followBtn[i].setAttribute("href", "sendMessage.php?idReceveur=" + idUserFollow);
                console.table(idUserFollow)
                followAdd(idUserFollow)

            })
        }
    }
}, 1000)

/*Ajout d'un follow*/
/*Cette fonction envoie une requete ajax ver addFollow.php*/
function followAdd(idSuivie) {
    let idUserCo = document.querySelector("#idUserConnecter").innerText;
    console.log("suiveur id " + idUserCo)
    console.log("suivie id " + idSuivie)
    var postLike;
    var result;
    let url = "http://phphetic/HETIX/API/addFollow.php?idSuivie=" + idSuivie + "&idSuiveur=" + idUserCo
    var request2 = new XMLHttpRequest();
    console.log("AJAX REQUEST")
    request2.onreadystatechange = (event) => {
        if (request2.readyState == 1) {
            console.log(request2.readyState)
        }
    }
    request2.onprogress = (progressEvent) => {

        console.log("LOADINGGG following /..." + progressEvent)
    }


    request2.onload = () => {
        postLike = JSON.parse(request2.responseText);


    }

    let async = true;
    // Initialize It.
    request2.overrideMimeType("application/json");
    request2.open("GET", url, async);

    // Send it (Without body data)
    request2.send();

    return result;





}