/**
 * Notyf est une petite bibliotheque de 35ko qui permet de gerer les notifications Push
*/
/*😀On crée une instance de Notyf afin de customiser nos notification push de type erreur et success*/
var notyf = new Notyf(
    {
        types: [
          {
            className : "erreurText",
            type: 'erreur',
            background: '#ffecec',
            icon: {
                className: 'erreur-icons',
                tagName: 'i'
                
              }
          },
          {
            type: 'success',
            background: '#58ca9a',
            icon: {
                className: 'success-icons',
                tagName: 'i'
                
              }
          }
        ]
      }
);

/**
 * GESTION DES ERREURS ET DES NOTIFICATION EN FONCTION DU PARAMETRE RENVOYER DANS L'URL EN GET
 * Dans la variable erreur
 */
/** 
*GetAllUrlParams() est une fonction custom qui me permet de recuperer les informations get dans l'url
*Et d'en faire un tableau
*nb : elle est déclarer dans le fichier urlParam.js
*/
if (getAllUrlParams().confirme) {
   
    switch (getAllUrlParams().confirme) {
        case "1":
            notyf.open({
                type: 'success',
                message: 'Votre compte à été vérifier avec succès',
                position: {
                    x: 'center',
                    y: 'top',
                  }
              })
           
            break;

        case "2":
            notyf.open({
                type: 'erreur',
                message: 'Votre compte a déjà été confirmer !',
                position: {
                    x: 'center',
                    y: 'top',
                  }
              });
            break;
    
      
    }
   
}


if (getAllUrlParams().erreur) {
   
    switch (decodeURI(getAllUrlParams().erreur)) {
       
        case "emailalreadyexit":
          console.log("L'email entré existe déja");
            notyf.open({
                type: 'erreur',
                message: 'Cette email est déja liée à un compte ! Veuillez vous connecter',
                position: {
                    x: 'center',
                    y: 'top',
                  }
              });
            break;
    
      
    }
   
}

if (getAllUrlParams().erreur) {
  
  switch (decodeURI(getAllUrlParams().erreur)) {
     
      case "4":
        console.log("deconnexion Innatendu");
           notyf.open({
               type: 'erreur',
               message: 'Erreur : Veuillez vous reconnecter à votre compte !',
               position: {
                   x: 'center',
                   y: 'top',
                 }
             });
           break;
   
     
   }
  
}


if (getAllUrlParams().erreur) {
  
  switch (decodeURI(getAllUrlParams().erreur)) {
   
      case "5":
        console.log("Mdp ou email incorrect ");
           notyf.open({
               type: 'erreur',
               message: 'Une erreur est survenue : Le mot de passe ou l \'email entré semble incorrect !',
               position: {
                   x: 'center',
                   y: 'top',
                 }
             });
           break;
   
     
   }
  
}



if (getAllUrlParams().message) {
  
  switch (decodeURI(getAllUrlParams().message)) {
   
      case "deconnexionreussie":
        console.log("Deconnexion réussi ");
           notyf.open({
               type: 'success',
               message: 'Deconnexion réussie!',
               position: {
                   x: 'center',
                   y: 'top',
                 }
             });
           break;
   
     
   }
  
}




