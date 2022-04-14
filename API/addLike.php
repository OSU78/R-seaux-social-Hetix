<?php
require_once("../INCLUDES/config.php");

/*Fonction pour recuperer le nombre de like et de commentaire d'un post*/

if(isset($_GET["idPost"]) && isset($_GET["idUser"])){

    $idPost=htmlspecialchars($_GET["idPost"]);
    $idUser=htmlspecialchars($_GET["idUser"]);

    $ifLike = $bdd->prepare(' SELECT COUNT(*) FROM likecounter WHERE id_user=? and id_post=?');
    //var_dump($allPost);
    $ifLike->execute( array($idUser,$idPost));
    // //print_r($email);
    // //print_r($mdpsec);
   //echo($ifLike->fetchAll()[0][0]);
    //die();

    
    if($ifLike->fetchAll()[0][0]<1){
      // print_r($ifLike->fetchAll()[0][0]);
       // die();
       
    $allPost = $bdd->prepare('INSERT INTO likecounter VALUES (0,?,?)');
    //var_dump($allPost);
    $allPost->execute( array($idUser,$idPost));
    // //print_r($email);
    // //print_r($mdpsec);
    $arrayAllPost = array();
  
   /* while($row =$allPost->fetchAll())
    {
        $arrayAllPost[] = $row;
    }
    var_dump($arrayAllPost);*/
   $response=[
       "idPost"=>$idPost,
       "idUser"=>$idUser,
    "code"=>"204",
    "message"=>"Like de post"
    ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
    }

    else{
        print_r($ifLike->fetchAll()[0]);
    }

}
