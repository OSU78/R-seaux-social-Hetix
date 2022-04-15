var idReceveur = parseInt(getAllUrlParams().idreceveur)
var idUser = parseInt(document.querySelector("#idUserConnecter").innerText)
document.querySelector("#sendMsg").addEventListener("click", () => {
    let msg = document.querySelector("#messageContent").value;
    console.log("Envoyer message de : " + idUser + " à " + idReceveur);
    if (msg.replace(/\s+/g, '').length > 1) {
        console.log(msg);
        document.querySelector("#messageContent").value="";

        let msgValue = msg.replace(/\s+/g, '').value;
        console.log("Envoyer message de : " + idUser + " à " + idReceveur);
        //sendMessage(msg.replace(/\s+/g, ''),idReceveur)
        document.querySelector("#allMessage").innerHTML+="<div class='oneMsg'><li class='messageBox positionR'>"+msg+"</li></div>"
         sendMessage(msg, idUser, idReceveur)

    }

}
)





/*Function d'ajout de like*/
/*Cette fonction envoie une requete ajax ver sendMessage.php*/
function sendMessage(message, idUser, idReceveur) {


    var responseAddMsg;
    let url = "http://phphetic/HETIX/API/sendMessage.php?idReceveur=" + idReceveur + "&idUser=" + idUser + "&msg=" + message;
    var reqMessageAdd = new XMLHttpRequest();
    console.log(url)
    reqMessageAdd.onreadystatechange = (event) => {
        if (reqMessageAdd.readyState == 1) {
            console.log(reqMessageAdd.readyState)
            console.log("toto")
        }


    }
    reqMessageAdd.onprogress = (progressEvent) => {

        console.log("Add Message /..." + progressEvent)
    }


    reqMessageAdd.onload = () => {
        // document.getElementById("lottieForPost").style.display="none"
        // responseAddMsg = JSON.parse(reqMessageAdd.responseText);
        //dataDiv.innerText=allPostData
        document.querySelector("#allMessage").scrollTo(0,document.querySelector("#allMessage").scrollHeight+100);

    }

    let async = true;
    // Initialize It.
    reqMessageAdd.overrideMimeType("application/json");
    reqMessageAdd.open("GET", url, async);
    // Send it (Without body data)
    reqMessageAdd.send();


}











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
      //  console.table(xmlMessage);
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
    // console.table(data["lui"][0])
    data[0].forEach(function (array) {
        let element = document.createElement("div")
        element.className = " oneMsg"

        if (array['id_envoyeur'] ==idUser ) {
            element.innerHTML = "<li class='messageBox positionR'>"+array["message"]+"</li>"

        } else {
            element.innerHTML = "<li class='messageBox positionL'>"+array["message"]+"</li>"
        }
        allMessage.appendChild(element)
        

    });


}

window.setTimeout(()=>{
    document.querySelector("#allMessage").scrollTo(0,document.querySelector("#allMessage").scrollHeight+100);

},400)


createRequest("http://phphetic/HETIX/API/allMessage.php?idReceveur="+idReceveur+"&idEnvoyeur="+idUser)

setInterval(() => {
    // allMessage.innerHTML=" "
    
    createRequest("http://phphetic/HETIX/API/allMessage.php?idReceveur="+idReceveur+"&idEnvoyeur="+idUser);

}, 800)












