<?php
require_once("../INCLUDES/config.php");
//Fonction pour recuperer tout les post

    $response= array();
    if(isset($_GET["limit"]) && isset($_GET["offset"]) ){
        $limit=(int)htmlspecialchars($_GET["limit"]);
        $offset=(int)htmlspecialchars($_GET["offset"]);
        echo $limit;
        echo $offset;
        $allPost = $bdd->prepare('SELECT * FROM post limit '.(int)$limit.' OFFSET '.(int)$offset.'ORDER BY id_post DESC');
   
    }
    else{
        $allPost = $bdd->prepare('SELECT * FROM post INNER JOIN user u ON u.id = post.id_user ORDER BY id_post DESC;');
        
    }
    //var_dump($allPost);
    $allPost->execute();
    $id_user=htmlspecialchars($_GET["userId"]);
    // echo $id_user;
    // die();
    // //print_r($email);
    // //print_r($mdpsec);
    $arrayAllPost = array();
    while($row =$allPost->fetchAll())
    {

        for($i=0;$i<sizeof($row);$i++){
            $postLike = $bdd->prepare('SELECT COUNT(id_like) FROM likecounter where id_post=?;');
        $postLike->execute(array($row[$i]["id_post"]));
        $CountLike=$postLike->fetch()[0];


        $ifLike = $bdd->prepare(' SELECT COUNT(*) FROM likecounter WHERE id_user=? and id_post=?');
        //var_dump($allPost);
        $ifLike->execute( array($id_user,$row[$i]["id_post"]));
       $ifLike2=$ifLike->fetchAll()[0][0];
         if($ifLike2>0){
             //echo($ifLike2);
             //die();
             $row[$i]["isLike"]="islike";
            
         }
         else{
            $row[$i]["isLike"]="notLike";
         }
            $row[$i]["likeTotal"]=$CountLike;
            /*On recupère le nombre total des commentaires*/
         $postComment = $bdd->prepare('SELECT COUNT(*) FROM commentaire where id_post=?;');
         $postComment->execute(array($row[$i]["id_post"]));
         $countComment=$postComment->fetch()[0];
         $row[$i]["comTotal"]=$countComment;
        
        
        }
       
        //print_r($row[0]);
        //die();
        $arrayAllPost[] = $row;
        

        // print_r($row[0]);
        // die();
    }
    //print_r($arrayAllPost);
   $response=[
       "response"=>$arrayAllPost,
       "code"=>"204",
       "message"=>"Tout les posts"
   ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);


?>