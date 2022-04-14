var xmlString = 0;
var divAbonnement = document.getElementById("abonnement")
var dataDiv = document.getElementById("data")


function getFollowing(url) {

    var request = new XMLHttpRequest();
    console.log("AJAX REQUEST")
    request.onreadystatechange = (event) => {
        if (request.readyState == 1) {
            console.log(request.readyState)
            if (document.getElementById("lottie")) {
                document.getElementById("lottie").style.display = "block"
                document.getElementById("lottie").classList.toggle("block")
            }
        }
    }
    request.onprogress = (progressEvent) => {
        if (document.getElementById("lottie")) {
            document.getElementById("lottie").style.display = "block"
            document.getElementById("lottie").classList.toggle("block")
            console.log("LOADINGGG /..." + progressEvent)
        }
    }


    request.onload = () => {
        if (document.getElementById("lottie")) {
            document.getElementById("lottie").style.display = "none"
        }
        xmlString = JSON.parse(request.responseText);
        divAbonnement.innerHTML = " "
        //dataDiv.innerText=xmlString
        let nbAbonnement=xmlString["abonnement"]["nombreAbonnement"]
        let nbAbonner=xmlString["abonner"]["nombreAbonner"]
      // console.log(nbAbonnement)
    //    exit()
       allFollowInsert(xmlString,nbAbonnement,nbAbonner)

    }

    let async = true;
    // Initialize It.
    request.overrideMimeType("application/json");
    request.open("GET", url, async);

    // Send it (Without body data)
    request.send();

    return xmlString;



}



function allFollowInsert(data,nbAbonnement,nbAbonner) {
    data["abonnement"][0].forEach(function (array) {

        console.log("affichage")
        let pictureProfil = array['imageProfil']
      
        let urlPictureProfil = "ASSETS/profilPicture/" + pictureProfil;
        console.log(urlPictureProfil)
    
       document.querySelector(".countAbonnement").innerText=nbAbonnement;
       document.querySelector(".countAbonner").innerText=nbAbonner;
       
        let element = document.createElement("div")
        element.className = " flex columns center suggest"
        if (array['isFollow'] == "yes") {
            element.innerHTML = "<li  class='flex center row center maxWidth cursorNone spaceBetween'> <div class='flex flexStartJ'> <img class='circle_span' src='" + urlPictureProfil + "' alt='' width='25px'> <p idUser='"+ array['id'] +"' style='font-weight: 200;font-size: 13px;' class='colorBlack suggestItem'>" + array['pseudo'] + "</p> </div> <div class='flex center row'> <a href='message.php?" + array['id'] + "' class='links sendMessage' idUser='" + array['id'] + "'>ecrire</a> </div> </li idUser='"+ array['id'] +"'>"

        } else {
            element.innerHTML = "<li  class='flex center row center maxWidth cursorNone spaceBetween '> <div class='flex flexStartJ'> <img class='circle_span' src='" + urlPictureProfil + "' alt='' width='25px'> <p idUser='"+ array['id'] +"' style='font-weight: 200;font-size: 13px;' class='colorBlack suggestItem'>" + array['pseudo'] + "</p> </div> <div class='flex center row'> <a href='sendmessage.php?idReceveur="+array['id']+"' class='links follow refreshSuggest ' idUser='" + array['id'] + "'>écrire</a> </div> </li idUser='"+ array['id'] +"'>"

        }
        divAbonnement.appendChild(element)

    });


}


getFollowing("http://phphetic/HETIX/API/followInfo.php?getAllFollowers=1&uId="+getAllUrlParams().id)


function lookAbonnement(){
    let nbAbonnement=document.querySelector(".nbAbonnement").style.cssText="display: flex"
}
function exitModalAbonnement(){
    let nbAbonnement=document.querySelector(".nbAbonnement").style.cssText="display: none"


}