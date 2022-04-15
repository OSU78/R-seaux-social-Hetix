<?php
require_once("../INCLUDES/config.php");
require_once("uploadImage.php");


if (isset($_GET["getAllFollowers"]) && isset($_GET["uId"])) {

    $abonnement = array();
    $abonner=array();
    $uId = htmlspecialchars($_GET["uId"]);

    $req_abonnement = $bdd->prepare('SELECT * FROM follow INNER join user u ON u.id=id_suivi WHERE id_suiveur=?');
    //var_dump($req_abonnement);
    $req_abonnement->execute(array($uId));
    //print_r($email);
    //print_r($mdpsec);



    while ($row = $req_abonnement->fetchAll()) {

        $abonnement[] = $row;
    }
   // print_r(sizeof($abonnement));
    //die();
   
    /*Requette pour recuperer les abonnées*/

    $req_abonner = $bdd->prepare('SELECT * FROM follow INNER join user u ON u.id=id_suiveur WHERE id_suivi=?');
    //var_dump($req_abonner);
    $req_abonner->execute(array($uId));
    //print_r($email);
    //print_r($mdpsec);

    

    while ($row2 = $req_abonner->fetchAll()) {

        $abonner[] = $row2;
    }
    // print_r(sizeof($abonnement));
    // die();
    if(sizeof($abonnement)==0){
        $abonnement["nombreAbonnement"] = 0;
     
   
    }
    else{
      
        $abonnement["nombreAbonnement"] = sizeof($abonnement[0]);
    }
    
    if(sizeof($abonner)==0){
        $abonner["nombreAbonner"] = 0;
    }
    else{
       
        $abonner["nombreAbonner"] = sizeof($abonner[0]);
    }
    



    $response=[
        "abonnement"=>$abonnement,
        "abonner"=>$abonner,
     "code"=>"204",
     "message"=>"Info follower"
     ];
     header('Content-Type: application/json; charset=utf-8');
     echo json_encode($response);

}
