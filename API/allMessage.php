<?php
require_once("../INCLUDES/config.php");

if(isset($_GET["idEnvoyeur"]) && isset($_GET["idReceveur"])){
    $idEnvoyeur = htmlspecialchars($_GET["idEnvoyeur"]) ;
    $idReceveur = htmlspecialchars($_GET["idReceveur"]) ;
    
    $response= array();
    $req_AllMessage = $bdd->prepare('SELECT * FROM messagerie where id_envoyeur=? and id_receveur=? OR id_envoyeur=? and id_receveur=? ORDER BY id_messagerie ASC;');
    //var_dump($req_AllMessage);
    $req_AllMessage->execute(array($idEnvoyeur,$idReceveur,$idReceveur,$idEnvoyeur));
    //print_r($email);
    //print_r($mdpsec);
    
  

    while($row =$req_AllMessage->fetchAll())
    {
     
    $response[]=$row;
}



   
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
}
