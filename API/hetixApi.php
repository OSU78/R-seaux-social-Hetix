<?php
require_once("../INCLUDES/config.php");
require_once("uploadImage.php");


if(isset($_GET["allSuggestion"])){

    $response= array();
    $req_user = $bdd->prepare('SELECT * FROM user where id!=? ORDER BY RAND() LIMIT 3');
    //var_dump($req_user);
    $req_user->execute(array($_SESSION['id']));
    //print_r($email);
    //print_r($mdpsec);
    
  

    while($row =$req_user->fetchAll())
    {
     
        for($i=0;$i<sizeof($row);$i++){
    
    $req_ifFollow = $bdd->prepare('SELECT COUNT(id_follow) FROM follow WHERE id_suiveur=? and id_suivi=?');
    //var_dump($req_user);
    $req_ifFollow->execute(array($_SESSION['id'],$row[$i]["id"]));
    $ifFollow2=$req_ifFollow->fetchAll()[0][0];

    if($ifFollow2>0){
        //echo($ifFollow2);
        //die();
        $row[$i]["isFollow"]="yes";
    }
    else{
       $row[$i]["isFollow"]="no";
    }
        
    }
    $response[]=$row;
}

// print_r($response);
// die();

   
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
}

if(isset($_GET["createNewPost"])){
    $chemin=uploadImage($_FILES["postimage"],$_SESSION["id"],"../ASSETS/post/");
    //echo($chemin);
    $response= array();
    //var_dump($_FILES["postImage"]);
    $add_user = $bdd->prepare('INSERT INTO post VALUES(0,?,?,?,"post","public",DEFAULT)');
    //var_dump($add_user);
    $add_user->execute(array($_SESSION['id'],$chemin["nomImage"],$_POST['postdescription']));
    // //print_r($email);
    // //print_r($mdpsec);
   $response=[
       "code"=>"204",
       "message"=>"Post crée avec succès",
       "PostImage"=>$chemin["cheminComplet"],
       "PostDescription"=>$_POST['postdescription']
   ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);

}






?>