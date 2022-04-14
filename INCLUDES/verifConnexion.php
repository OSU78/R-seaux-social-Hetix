<?php
require_once('config.php');

require_once("createSession.php");
if (isset($_POST['submit'])) {

    if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['mdp1']) && !empty($_POST['mdp1'])) {
        //var_dump($_POST);
        $email = htmlspecialchars($_POST['email']);
        $mdp = htmlspecialchars($_POST['mdp1']);
        $mdpsec = hash('sha256', $mdp);
        $req_user = $bdd->prepare('SELECT * FROM user WHERE email =? AND mdp =?');
        //var_dump($req_user);
        $req_user->execute(array($email, $mdpsec));
        //print_r($email);
        //print_r($mdpsec);
        $user_info = $req_user->fetch();
        //var_dump($user_info);
        $user_exist = $req_user->rowCount();
        if ($user_exist >= 1) {
            createSession($user_info);
            header("Location:../homePage.php?email=" . $_SESSION['pseudo'] . "&ID=" . $_SESSION['session_start']);
        } else {
            $erreur = "Mot de passe ou email incorrect";
            header("Location:../connexion.php?erreur=5");
            
        }
    } else {
        $erreur = "Veuiller renseigner tous les champs";
    }
}
