<?php
require_once("../INCLUDES/config.php");

/*Fonction pour ajouter un follow à une personne*/

if(isset($_GET["idSuiveur"]) && isset($_GET["idSuivie"])){

    $idSuiveur=htmlspecialchars($_GET["idSuiveur"]);
    $idSuivie=htmlspecialchars($_GET["idSuivie"]);
    
    
    $ifFollow = $bdd->prepare(' SELECT COUNT(*) FROM follow WHERE id_suiveur=? and id_suivi=?');
    //var_dump($allPost);
    $ifFollow->execute( array($idSuiveur,$idSuivie));
    $r=$ifFollow->fetchAll()[0][0];
    if($r<1){
       //print_r($ifFollow->fetchAll()[0][0]);
    $addFollow = $bdd->prepare('INSERT INTO follow VALUE (0,?,?)');
    $addFollow->execute( array($idSuiveur,$idSuivie));
  
   $response=[
       "idSuiveur"=>$idSuiveur,
       "idSuivie"=>$idSuivie,
    "code"=>"204",
    "message"=>"Ajout follow"
    ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
    }

    else{
        print_r($r);
    }

}
