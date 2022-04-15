<?php
require_once("../INCLUDES/config.php");

/*Fonction pour recuperer le nombre de like et de commentaire d'un post*/

if (isset($_GET["idReceveur"]) && !empty($_GET["msg"])) {


    $msg = htmlspecialchars($_GET["msg"]);
    $idEnvoyeur = htmlspecialchars($_SESSION["id"]);
    $idReceveur = htmlspecialchars($_GET["idReceveur"]);

    $addMessage = $bdd->prepare('INSERT INTO messagerie VALUES(0,?,?,?,DEFAULT)');
    //var_dump($allPost);
    $addMessage->execute(array($msg, $idEnvoyeur, $idReceveur));


    $allPost = $bdd->prepare('INSERT INTO likecounter VALUES (0,?,?)');
    //var_dump($allPost);
    $allPost->execute(array($idReceveur, $idPost));
    // //print_r($email);
    // //print_r($mdpsec);
    $arrayAllPost = array();


    $response = [
        "idEnvoyeur" => $idEnvoyeur,
        "idReceveur" => $idReceveur,
        "msg" => $msg,
        "code" => "204",
        "message" => "Like de post"
    ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
}
