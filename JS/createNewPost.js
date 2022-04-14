var postSubmit = document.querySelector("#createNewPost");
var xmlString2;
function createPost(url,postImage,newPostDescription) {

    var request = new XMLHttpRequest();
    var formData = new FormData();
    console.log("POST REQUEST")
    request.onreadystatechange = (event) => {
        if (request.readyState == 1) {
            console.log(request.readyState)
            var div=document.createElement("div");
       
            div.id="lottiePostSuccess"
            div.classList="flex center"
            div.innerHTML='<lottie-player id="lottie2" src="ASSETS/icones/loadSuccess.json" background="transparent" speed="2" style="width: 100px; height: 100px;position: absolute;top: 25%;" autoplay></lottie-player>';
            document.querySelector(".postModal").appendChild(div)
         document.getElementById("createPostMod").style.cssText = "display:none"
            document.getElementById("lottieCreatePost").style.cssText = "display:flex;justify-content : center";
            document.getElementById("lottieCreatePost").classList.toggle("block")
            document.getElementById("dragSize").style.cssText = "display:none"
        }
        
        //console.log("POSTDescription : "+newPostDescription);
        formData.append('postdescription',newPostDescription)
        console.table(document.querySelector("#inputFile").files);
        formData.append('postimage',document.querySelector("#inputFile").files[0]);
        // Send it (Without body data)
        request.send(formData);
    }
    request.onprogress = (progressEvent) => {
        console.log("Post en cours /..." + progressEvent)
        
    }


    request.onload = () => {
        
        document.getElementById("lottieCreatePost").style.cssText = "display:none";
        document.querySelector(".postModal").classList.toggle("block")
        //document.getElementById("lottiePostSuccess").style.cssText = "display : flex";
        
        xmlString2 = JSON.parse(request.responseText);
       // suggestion.innerHTML = " "
        //dataDiv.innerText=xmlString
        component(xmlString)

    }

    let async = true;
    // Initialize It.
    request.overrideMimeType("application/json");
    request.open("POST", url, async);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    return xmlString2;



}


postSubmit.addEventListener("click", (e) => {
    e.preventDefault();
    var newPostDescription = document.querySelector("#newPostDescription");
    var postImage = uploaded_image ? uploaded_image : uploaded_image2;
    if (postImage) {
createPost("http://phphetic/HETIX/API/hetixApi.php?createNewPost=true",postImage,newPostDescription.value);
       
console.table(xmlString2);
}
})