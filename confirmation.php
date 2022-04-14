<?php
 include('INCLUDES/config.php');

 if(isset($_GET['email'], $_GET['key']) AND !empty($_GET['email']) AND !empty($_GET['key'])) {
   $email = htmlspecialchars(urldecode($_GET['email']));
   $key = htmlspecialchars(urldecode($_GET['key']));
   
   $requser = $bdd->prepare("SELECT * FROM user WHERE email = ? AND keyc = ?");
   $requser->execute(array($email, $key));
   $userexist = $requser->rowCount();
   if($userexist == 1) {
      $user = $requser->fetch();
      if($user['userVerifier'] == 0) {
         $updateuser = $bdd->prepare("UPDATE user SET userverifier = 1 WHERE email = ? AND keyc = ?");
         $updateuser->execute(array($email,$key));
         header('Location:connexion.php?confirme=1');
         echo "Votre compte a bien ete confirmer !";
      } else {
        header('Location:connexion.php?confirme=2');
         echo "Votre compte a deja ete confirme !";
      }
   } else {
      echo "L'utilisateur n'existe pas !";
   }
}
?>

