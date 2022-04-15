var xmlMessage
var dataDiv = document.getElementById("data")
var allMessage = document.getElementById("allMessage")

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
        xmlMessage = JSON.parse(request.responseText);
        allMessage.innerHTML = " "
        //dataDiv.innerText=xmlMessage
        createMessageHtml(xmlMessage)

    }

    let async = true;
    // Initialize It.
    request.overrideMimeType("application/json");
    request.open("GET", url, async);

    // Send it (Without body data)
    request.send();

    return xmlMessage;



}


function createMessageHtml(data) {
    data[0].forEach(function (array) {
        let element = document.createElement("div")
        element.className = " oneMsg"

        if (array['id_envoyeur'] ==idUser ) {
            element.innerHTML = "<li class='messageBox positionR'>"+array["msg"]+"</li>"

        } else {
            element.innerHTML = "<li class='messageBox positionL'>"+array["msg"]+"</li>"
        }
        allMessage.appendChild(element)

    });


}




createRequest("http://phphetic/HETIX/API/allMessage.php?idReceveur="+idReceveur+"&idEnvoyeur="+idUser)

setInterval(() => {
    // allMessage.innerHTML=" "
    createRequest("http://phphetic/HETIX/API/allMessage.php?idReceveur="+idReceveur+"&idEnvoyeur="+idUser);

}, 10000)