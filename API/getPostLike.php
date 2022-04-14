<?php
require_once("../INCLUDES/config.php");

/*Fonction pour recuperer le nombre de like et de commentaire d'un post*/

if(isset($_GET["idPost"])){

    $idPost=htmlspecialchars($_GET["idPost"]);
    $allPost = $bdd->prepare('SELECT COUNT(id_like) FROM likecounter where id_post=?');
    //var_dump($allPost);
    $allPost->execute( array($idPost));
    // //print_r($email);
    // //print_r($mdpsec);
    $arrayAllPost = array();
  
   /* while($row =$allPost->fetchAll())
    {
        $arrayAllPost[] = $row;
    }
    var_dump($arrayAllPost);*/
   $response=[
    "nombreLike"=>$allPost->fetch()[0],
    "code"=>"204",
    "message"=>"Nombre de like du post"
    ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);


}
