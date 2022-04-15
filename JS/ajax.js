var xmlString = 0;
//var url="https://restcountries.com/v2/lang/en"
var projetDoc = "HETIX"

var dataDiv = document.getElementById("data")
var suggestion = document.getElementById("suggestion")

function createRequest(url) {

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
        suggestion.innerHTML = " "
        //dataDiv.innerText=xmlString
        component(xmlString)

    }

    let async = true;
    // Initialize It.
    request.overrideMimeType("application/json");
    request.open("GET", url, async);

    // Send it (Without body data)
    request.send();

    return xmlString;



}

function splite(mot, indice) {
    let resultSplit = mot.split("/")
    return resultSplit[indice]
}

function component(data) {
    data[0].forEach(function (array) {

        console.log("affichage")
        let pictureProfil = array['imageProfil']
        let pathName = splite(window.location.pathname, 1)
        let urlPictureProfil = "ASSETS/profilPicture/" + pictureProfil;
        console.log(urlPictureProfil)

        let element = document.createElement("div")
        element.className = " flex columns center suggest"
        if (array['isFollow'] == "yes") {
            element.innerHTML = "<li  class='flex center row center maxWidth cursorNone spaceBetween'> <div class='flex flexStartJ'> <img class='circle_span' src='" + urlPictureProfil + "' alt='' width='25px'> <p idUser='"+ array['id'] +"' style='font-weight: 200;font-size: 13px;' class='colorBlack suggestItem'>" + array['pseudo'] + "</p> </div> <div class='flex center row'> <a href='sendMessage.php?idReceveur=" + array['id'] + "' class='links sendMessage' idUser='" + array['id'] + "'>ecrire</a> </div> </li idUser='"+ array['id'] +"'>"

        } else {
            element.innerHTML = "<li  class='flex center row center maxWidth cursorNone spaceBetween '> <div class='flex flexStartJ'> <img class='circle_span' src='" + urlPictureProfil + "' alt='' width='25px'> <p idUser='"+ array['id'] +"' style='font-weight: 200;font-size: 13px;' class='colorBlack suggestItem'>" + array['pseudo'] + "</p> </div> <div class='flex center row'> <a href='#' class='links follow refreshSuggest ' idUser='" + array['id'] + "'>S'abonner</a> </div> </li idUser='"+ array['id'] +"'>"

        }
        suggestion.appendChild(element)

    });


}
window.setInterval(() => {
    console.log("REFRESH1");
    let refresh = document.querySelectorAll(".refreshSuggest")
    if (document.querySelectorAll(".refreshSuggest")) {
        for (let i = 0; i < refresh.length; i++) {
            refresh[i].addEventListener("click", (e) => {
                e.preventDefault()
                refresh[i].innerText = "ecrire";
                followAdd(refresh[i].attributes[2].value);
                console.log("REFRESH");
                createRequest("http://phphetic/HETIX/API/hetixApi.php?allSuggestion")
            })
        }
    }
}, 1000)

window.setInterval(() => {
    console.log("suggestItem");
    let suggestItem = document.querySelectorAll(".suggestItem")
    if (document.querySelectorAll(".suggestItem")) {
        for (let i = 0; i < suggestItem.length; i++) {
           
            suggestItem[i].addEventListener("click", (e) => {
                window.location.href = "profil.php?id="+ suggestItem[i].attributes[0].value;
            })
        }
    }
}, 1000)




createRequest("http://phphetic/HETIX/API/hetixApi.php?allSuggestion")

setInterval(() => {
    // suggestion.innerHTML=" "
    createRequest("http://phphetic/HETIX/API/hetixApi.php?allSuggestion");



}, 10000)