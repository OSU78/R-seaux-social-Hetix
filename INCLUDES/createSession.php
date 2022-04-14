<?php
/*Cette fonction prend en parametre un tableau
*Elle permet de crée la session de l'utilisateur avec les tables
*differente info stocker dans la session
*/
//require_once("config.php");
function createSession($user_info){
    
    $_SESSION['session_start'] = 1;
            $_SESSION['id'] = $user_info['id'];
            $_SESSION['nom'] = $user_info['nom'];
            $_SESSION['prenom'] = $user_info['prenom'];
            $_SESSION['pseudo'] = $user_info['pseudo'];
            $_SESSION['email'] = $user_info['email'];
            $_SESSION['bio'] = $user_info['bio'];
            $_SESSION['avatar'] = $user_info['imageProfil'];
            $_SESSION['badge'] = $user_info['userVerifier'];
}
echo "tto";

function deconnexion(){ 
    

if(!empty($_SESSION['session_start']) and $_SESSION['session_start']==1){


	$_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
	session_destroy();
	header("location:./connexion.php?message=deconnexionreuissie");}else{header("Location:homepage.php?erreur=erreurdeconnexion");}

}

?>