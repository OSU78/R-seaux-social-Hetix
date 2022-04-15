/*Code js pour le theme sombre N'est pas utilisé actuellement dans le site*/
let theme = document.querySelector('.theme');

function themeSombre() {
    theme.style.cssText = "background : var(--theme-sombre);color : var(--text-colorWhite)";


    return console.log(themeSombre);
}
/* --------------- */




/*Variable qui va stocker l'image lorsque l'utilisateur voudra poster une publication*/
var postImage
const image_drop_area = document.querySelector("#dragSize");
/*Variable qui va stocker l'image lors du choix sur l'ordinateur*/
var uploaded_image = "";
/*Variable qui va stocker l'image lors du drag and drop dans le navigateur*/
var uploaded_image2 = ""

// Event listener lorsqu'une image est drag and drop sur notre modal
if(document.querySelector("#dragSize")){
image_drop_area.addEventListener('dragover', (event) => {
    event.stopPropagation();
    event.preventDefault();
    document.querySelector(".createPost").style.backgroundColor = "rgb(0 0 0 / 67%)";
    document.querySelector(".postModal").style.border = "4px dashed #49ca9f"
    document.querySelector(".postModal").classList.add("scale1")
    //On stylise le glisser-déposer comme une opération de « copie de fichier ».
    event.dataTransfer.dropEffect = 'copy';
});

image_drop_area.addEventListener('dragleave', (event) => {
    event.stopPropagation();
    event.preventDefault();
    document.querySelector(".createPost").style.backgroundColor = "rgb(0 0 0 / 28%)";
    document.querySelector(".postModal").classList.remove("scale1")
    document.querySelector(".postModal").style.border = "4px dashed transparent"


});

// Écouteur d’événement pour déposer l’image à l’intérieur du div
image_drop_area.addEventListener('drop', (event) => {
    event.stopPropagation();
    event.preventDefault();
    document.querySelector(".createPost").style.backgroundColor = "rgb(0 0 0 / 28%)";
    fileList = event.dataTransfer.files;
    document.querySelector(".postModal").classList.remove("scale1")
    /*On insère l'image dans l'input files*/
    document.querySelector("#inputFile").files=event.dataTransfer.files;
    //document.querySelector("#nom_input_file").textContent = fileList[0].name;
    console.table(fileList)
    if (fileList[0].size > 1800000) {
        console.log("erreur : taille de l'image trop élévé !");
        notyf.open({
            type: 'erreur',
            message: 'taille de l\'image trop élévé !',
            position: {
                x: 'center',
                y: 'top',
            }
        });
    } else {
       
        document.querySelector(".modalAppear").classList.remove("block")
        document.querySelector("#createPostMod").style.display = "flex"
        readImage(fileList[0]);
    }


});
}

// On convertit l’image en URI de données
//Sert en meme temps de fonction pour placer l'image qui a été drag and drop dans une div
readImage = (file) => {
    const reader = new FileReader();
    reader.addEventListener('load', (event) => {

        uploaded_image = event.target.result

        console.log(uploaded_image)
        postImage = uploaded_image
     
        document.getElementById('formPost').style.display = 'flex'
        document.querySelector(".dragsvg").style.display = "none";
        document.querySelector(".psvg").style.display = "none"
        document.querySelector("#imageDiv").style.cssText = "min-height:400px;min-width:400px"
        document.querySelector("#imageDiv").style.backgroundImage = `url(${uploaded_image})`;
        document.querySelector("#inputFile").style.display = "none"
        document.querySelector(".postModal").style.border = "none"
    });
    reader.readAsDataURL(file);
}




/*Cette fonction permet de transformer le blob file en base64 pour l'inserer dans la base de données après*/
function toDataURL(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        var reader = new FileReader();
        reader.onloadend = function () {
            callback(reader.result);
        }
        reader.readAsDataURL(xhr.response);
    };
    xhr.open('GET', url);
    xhr.responseType = 'blob';
    xhr.send();
}





/*Fonction permettant de placer l'image Lorsque l'utlisation clic sur chosir une image sur son ordinateur (fonction appeler sur la homepage.php*/
function showImage() {
    if (document.querySelector('.inputFile').files['0'].type == 'image/png' || document.querySelector('.inputFile').files['0'].type == 'image/jpeg') {

        toDataURL(window.URL.createObjectURL(document.querySelector("#inputFile").files[0]), function (dataUrl) {
            uploaded_image2 = dataUrl
        })
        console.log(uploaded_image2)
        document.getElementById('formPost').style.display = 'flex'
        document.querySelector('.psvg').style.display = 'none';
        document.querySelector('.dragsvg').style.display = 'none';
        document.querySelector('#inputFile').style.display = 'none';
        document.querySelector("#createPostMod").style.display = "flex"
        document.querySelector(".modalAppear").classList.remove("block");
        document.getElementById('imageDiv').style.cssText = 'min-height:400px;min-width:400px';
        document.getElementById('imageDiv').style.backgroundImage = 'url(' + window.URL.createObjectURL(document.querySelector("#inputFile").files[0]) + ')'
    } else {
        console.log('erreur');
        notyf.open({
            type: 'erreur',
            message: 'Format de l\'image incorrect !',
            position: {
                x: 'center',
                y: 'top',
            }
        });

    }
}

if(document.getElementById("exitCreatePostModal")){
/*Fonction lorsqu'on clic sur l'icone exit sur la modal Création d'un post*/
document.getElementById("exitCreatePostModal").addEventListener("click", () => {
    console.log("exitPostModal")
    if (document.querySelectorAll("#lottiePostSuccess")[1]) {

        document.querySelector(".modalAppear").removeChild(document.querySelectorAll("#lottiePostSuccess")[1])
    }
    if(document.querySelector("#lottiePostSuccess")){
        document.querySelector("#lottiePostSuccess").style.cssText = "display : none";
    }
     document.querySelector(".dragsvg").style.cssText = "display:block"
    document.querySelector(".psvg").style.cssText = "display:block"

    document.getElementById("dragSize").style.cssText = "display:block"
    document.getElementById("inputFile").style.cssText = "display:block"

    document.querySelector(".createPost").style.display = "none"
    document.querySelector(".postModal").classList.remove("modalAppear");
    document.querySelector(".createPost").classList.remove("bg-black");
    document.getElementById("lottiePostSuccess").style.display = "none"

})
}
if(document.getElementById("exitCreatePostModal")){
document.getElementById("createPostModal").addEventListener("click", () => {
    console.log("click")

    document.getElementById("dragSize").style.display = "flex"


    document.querySelector(".postModal").classList.toggle("modalAppear");
    document.querySelector(".createPost").style.display = "flex"
    document.querySelector(".createPost").classList.add("bg-black");

    if (document.getElementById("lottiePostSuccess")) {
        document.getElementById("lottiePostSuccess").style.display = "none"
    }
})
}