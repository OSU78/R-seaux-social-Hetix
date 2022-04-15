
var allPostData=0;
//var url="https://restcountries.com/v2/lang/en"

var dataDiv=document.getElementById("data")
var onepost=document.getElementById("onepost")
var idUser=parseInt(document.querySelector("#idUserConnecter").innerHTML);
var liked
function getAllPost(url){
  
    var request=new XMLHttpRequest();
   console.log("AJAX REQUEST")
request.onreadystatechange=(event)=>{
   if(request.readyState==1){
       console.log(request.readyState)
       document.getElementById("lottieForPost").style.display="block"
       document.getElementById("lottieForPost").classList.toggle("block")
   }
}
request.onprogress=(progressEvent)=>{
   
    console.log("LOADINGGG /..."+progressEvent)
}


request.onload=()=>{
   // document.getElementById("lottieForPost").style.display="none"
    allPostData =  JSON.parse(request.responseText);
    onepost.innerHTML=" "
    //dataDiv.innerText=allPostData
    console.table(allPostData["response"][0])
    allPostDiv(allPostData["response"][0])
  
}

let async = true;
// Initialize It.
request.overrideMimeType("application/json");
request.open("GET", url, async);

// Send it (Without body data)
request.send();

return allPostData;



}

function splite(mot,indice){
    let resultSplit=mot.split("/")
    return resultSplit[indice]
}
function allPostDiv(data){
    data.forEach(function (array) {
       
        //console.log("affichage")
        let postImage= array["image_post"]
        let postDescription=array["description_post"]
        let postCreatorId =array["id"]
        let postId=array["id_post"];
        let postCreatorAvatar="ASSETS/profilPicture/"+array["imageProfil"]
        let postCreatorName=array["pseudo"]
        let postLike=array["likeTotal"]
        let postComment =array["comTotal"];
        let isLike =array["isLike"];
        
        if(isLike=="islike"){
liked="#61bf92"
        }
        else{

liked="#61bf9200"
        }

      
        let element=document.createElement("div")
        element.className="postCard flex center columns mgTop30"
        let postImageChemin="ASSETS/post/"+postImage
    //getTotalLike(postId)
        element.innerHTML='<div class="flex paddingLR10 center flexStartJ cursorNone" style="justify-content: flex-start;"> <img onclick="gotoprofil('+postCreatorId+');" class="circle_span cursorNone" loading="lazy" src="'+postCreatorAvatar+'" width="40px" alt=""> <p class="cursorNone">'+postCreatorName+'</p> </div> <style> </style> <div class="postImage cursorNone" loading="lazy" style="background-image:url('+postImageChemin+')"></div> <div class="postBtn flex center row spaceBetween paddingLR10 cursorNone"> <!-- La classe class="alreadyLike" permettra d"attribuer l"état like à l"icone --> <div class="flex gap20 cursorNone"> <div class="flex center cursorNone"><svg id="like_ico" postid="'+postId+'" action="add" width="35" height="35" loading="lazy" viewBox="0 0 50 50" fill="none" style="fill:'+liked+'"  xmlns="http://www.w3.org/2000/svg"> <path  d="M15.625 8.33333C9.29683 8.33333 4.16663 13.4635 4.16663 19.7917C4.16663 31.25 17.7083 41.6667 25 44.0896C32.2916 41.6667 45.8333 31.25 45.8333 19.7917C45.8333 13.4635 40.7031 8.33333 34.375 8.33333C30.5 8.33333 27.0729 10.2573 25 13.2021C23.9434 11.6971 22.5397 10.4688 20.9078 9.62134C19.2759 8.77384 17.4638 8.33203 15.625 8.33333Z" postid="'+postId+'" action="add" stroke="#58CA9A" stroke-width="4.16667" stroke-linecap="round" stroke-linejoin="round" /> </svg> <p class="cursorNone">'+postLike+' likes</p> </div><div class="flex center"><svg id="commentaire_ico" width="35" height="35" viewBox="0 0 50 50" fill="none" loading="lazy" xmlns="http://www.w3.org/2000/svg"> <path d="M22.6563 25C22.6563 25.6216 22.9032 26.2177 23.3428 26.6573C23.7823 27.0968 24.3784 27.3438 25 27.3438C25.6216 27.3438 26.2178 27.0968 26.6573 26.6573C27.0969 26.2177 27.3438 25.6216 27.3438 25C27.3438 24.3784 27.0969 23.7823 26.6573 23.3427C26.2178 22.9032 25.6216 22.6563 25 22.6562C24.3784 22.6563 23.7823 22.9032 23.3428 23.3427C22.9032 23.7823 22.6563 24.3784 22.6563 25V25ZM32.4219 25C32.4219 25.6216 32.6688 26.2177 33.1084 26.6573C33.5479 27.0968 34.1441 27.3438 34.7657 27.3438C35.3873 27.3438 35.9834 27.0968 36.4229 26.6573C36.8625 26.2177 37.1094 25.6216 37.1094 25C37.1094 24.3784 36.8625 23.7823 36.4229 23.3427C35.9834 22.9032 35.3873 22.6563 34.7657 22.6562C34.1441 22.6563 33.5479 22.9032 33.1084 23.3427C32.6688 23.7823 32.4219 24.3784 32.4219 25ZM12.8907 25C12.8907 25.6216 13.1376 26.2177 13.5771 26.6573C14.0167 27.0968 14.6128 27.3438 15.2344 27.3438C15.856 27.3438 16.4522 27.0968 16.8917 26.6573C17.3312 26.2177 17.5782 25.6216 17.5782 25C17.5782 24.3784 17.3312 23.7823 16.8917 23.3427C16.4522 22.9032 15.856 22.6563 15.2344 22.6562C14.6128 22.6563 14.0167 22.9032 13.5771 23.3427C13.1376 23.7823 12.8907 24.3784 12.8907 25V25ZM45.1758 16.5234C44.0723 13.9014 42.4903 11.5479 40.4737 9.52637C38.4712 7.51658 36.0939 5.91905 33.4766 4.82422C30.791 3.69629 27.9395 3.125 25 3.125H24.9024C21.9434 3.13965 19.0772 3.72559 16.3819 4.87793C13.7869 5.98399 11.432 7.58436 9.44828 9.58984C7.4512 11.6064 5.88382 13.9502 4.79984 16.5625C3.67679 19.2676 3.11038 22.1436 3.12503 25.1025C3.1416 28.4935 3.94384 31.8345 5.46878 34.8633V42.2852C5.46878 42.8809 5.70542 43.4522 6.12665 43.8734C6.54787 44.2946 7.11918 44.5312 7.71488 44.5312H15.1416C18.1704 46.0562 21.5114 46.8584 24.9024 46.875H25.0049C27.9297 46.875 30.7666 46.3086 33.4375 45.2002C36.0417 44.1184 38.41 42.5395 40.4102 40.5518C42.4268 38.5547 44.0137 36.2207 45.1221 33.6182C46.2744 30.9229 46.8604 28.0566 46.875 25.0977C46.8897 22.124 46.3135 19.2383 45.1758 16.5234V16.5234ZM37.7979 37.9102C34.375 41.2988 29.834 43.1641 25 43.1641H24.917C21.9727 43.1494 19.0479 42.417 16.4649 41.04L16.0547 40.8203H9.17972V33.9453L8.95999 33.5352C7.58304 30.9521 6.85062 28.0273 6.83597 25.083C6.81644 20.2148 8.67679 15.6445 12.0899 12.2021C15.4981 8.75977 20.0537 6.85547 24.9219 6.83594H25.0049C27.4463 6.83594 29.8145 7.30957 32.0459 8.24707C34.2237 9.16016 36.1768 10.4736 37.8565 12.1533C39.5313 13.8281 40.8496 15.7861 41.7627 17.9639C42.71 20.2197 43.1836 22.6123 43.1739 25.083C43.1446 29.9463 41.2354 34.502 37.7979 37.9102V37.9102Z" fill="#58CA9A" /> </svg> <p>'+postComment+' commentaires</p></div></div> <svg class="favoris_ico" width="35" height="35" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.875 6.875C6.875 5.05164 7.59933 3.30295 8.88864 2.01364C10.178 0.724328 11.9266 0 13.75 0L41.25 0C43.0734 0 44.822 0.724328 46.1114 2.01364C47.4007 3.30295 48.125 5.05164 48.125 6.875V53.2812C48.1248 53.5921 48.0404 53.8972 47.8805 54.1639C47.7207 54.4305 47.4916 54.6489 47.2175 54.7956C46.9434 54.9423 46.6347 55.012 46.3241 54.9971C46.0136 54.9823 45.7129 54.8835 45.4541 54.7113L27.5 45.0347L9.54594 54.7113C9.28711 54.8835 8.98642 54.9823 8.67588 54.9971C8.36534 55.012 8.05658 54.9423 7.7825 54.7956C7.50841 54.6489 7.27926 54.4305 7.11945 54.1639C6.95965 53.8972 6.87516 53.5921 6.875 53.2812V6.875ZM13.75 3.4375C12.8383 3.4375 11.964 3.79966 11.3193 4.44432C10.6747 5.08898 10.3125 5.96332 10.3125 6.875V50.0706L26.5478 41.5387C26.8299 41.351 27.1612 41.2509 27.5 41.2509C27.8388 41.2509 28.1701 41.351 28.4522 41.5387L44.6875 50.0706V6.875C44.6875 5.96332 44.3253 5.08898 43.6807 4.44432C43.036 3.79966 42.1617 3.4375 41.25 3.4375H13.75Z" fill="#58CA9A" /> <path d="M27.5 13.75C27.9558 13.75 28.393 13.9311 28.7153 14.2534C29.0377 14.5757 29.2188 15.0129 29.2188 15.4688V20.625H34.375C34.8308 20.625 35.268 20.8061 35.5903 21.1284C35.9127 21.4507 36.0938 21.8879 36.0938 22.3438C36.0938 22.7996 35.9127 23.2368 35.5903 23.5591C35.268 23.8814 34.8308 24.0625 34.375 24.0625H29.2188V29.2188C29.2188 29.6746 29.0377 30.1118 28.7153 30.4341C28.393 30.7564 27.9558 30.9375 27.5 30.9375C27.0442 30.9375 26.607 30.7564 26.2847 30.4341C25.9623 30.1118 25.7812 29.6746 25.7812 29.2188V24.0625H20.625C20.1692 24.0625 19.732 23.8814 19.4097 23.5591C19.0873 23.2368 18.9062 22.7996 18.9062 22.3438C18.9062 21.8879 19.0873 21.4507 19.4097 21.1284C19.732 20.8061 20.1692 20.625 20.625 20.625H25.7812V15.4688C25.7812 15.0129 25.9623 14.5757 26.2847 14.2534C26.607 13.9311 27.0442 13.75 27.5 13.75Z" fill="#58CA9A" /> </svg> </div> <div class="postDescription" style="display:flex;justify-content:left;align-items:left;width: -webkit-fill-available;"> <p>'+postDescription+'</p> </div> <!-- <div class="postComment"> </div> -->'
          onepost.appendChild(element)
          let likeIco= document.querySelectorAll("#like_ico")
          let toto=document.querySelectorAll("#like_ico")
          for(let i = 0; i < toto.length; i++){toto[i].onclick = function (e) { 
              if(e.target.attributes[2].value=="add"){

                e.target.style.cssText="fill:#61bf92";
                console.log(e.target.attributes[1]); 
                console.log(e.target.attributes[2]); 
                e.target.attributes[2].value="removeLike"
                addLike(e.target.attributes[1].value)
              }
              else{
                e.target.style.cssText="fill:#61bf9200";
                e.target.attributes[2].value="add"
                console.log(e.target.attributes[2]); 
                
              }
        
      }}
    });


}

/*Function d'ajout de like*/
/*Cette fonction envoie une requete ajax ver addLike.php*/
function addLike(id){

var postLike;
var result;
  let url="http://phphetic/HETIX/API/addLike.php?idPost="+id+"&idUser="+idUser
    var request2=new XMLHttpRequest();
   console.log("AJAX REQUEST")
request2.onreadystatechange=(event)=>{
   if(request2.readyState==1){
       console.log(request2.readyState)
   }
}
request2.onprogress=(progressEvent)=>{
   
    console.log("LOADINGGG post like /..."+progressEvent)
}


request2.onload=()=>{
   // document.getElementById("lottieForPost").style.display="none"
    postLike =  JSON.parse(request2.responseText);
    //dataDiv.innerText=allPostData
    console.table(postLike["nombreLike"]);
    result=postLike["nombreLike"]
  
  
}

let async = true;
// Initialize It.
request2.overrideMimeType("application/json");
request2.open("GET", url, async);

// Send it (Without body data)
request2.send();

return result;



}



/*Cette fonction nous permettra de rediriger l'utlisateur vers la page profil lorsqu'il clic sur l'image d'un profil*/

function gotoprofil(id){
    window.location.href = "profil.php?id="+id;
}

/* ------------ */



getAllPost("http://phphetic/HETIX/API/getAllPost.php?userId="+idUser)

setInterval(()=>{
    // onepost.innerHTML=" "
     getAllPost("http://phphetic/HETIX/API/getAllPost.php?userId="+idUser)
 },1500)




 