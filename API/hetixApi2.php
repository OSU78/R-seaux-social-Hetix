<?php
require_once("../INCLUDES/config.php");


if(isset($_GET["allSuggestion"])){

    $response= array();
    $req_user = $bdd->prepare('SELECT * FROM user where id!=? ORDER BY RAND() LIMIT 3');
    //var_dump($req_user);
    $req_user->execute(array($_SESSION['id']));
    //print_r($email);
    //print_r($mdpsec);
    $user_info = $req_user->fetchAll(PDO::FETCH_ASSOC);

   
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($user_info);
}

if(isset($_GET["createNewPost"])){
    //Verif de la taille du fichier

    $maxsize = 2097152; //2Mo 210241024

$id=$_SESSION['id'];
$image_name=$id.".".date('Y-m-d-H-i-s');
var_dump((array)$_POST['postimage'][0]);
exit();
$filename=$_POST['postimage']['name'];
$temp_array=explode(".",$filename);/*permet de transformer une chaine de caractere en tableau*/
$extension=end($temp_array);/*on prend le dernier element du tableau avec end*/
$chemin_image='../ASSETS/post/'.$image_name.'.'.$extension;
/*Deplacement du fichier uploader vers son emplacement final*/


move_uploaded_file($_POST['postimage']['tmp_name'] , $chemin_image);

    
    $response= array();
 
    $add_user = $bdd->prepare('INSERT INTO post VALUES(0,?,?,?,"post","public",DEFAULT)');
    //var_dump($add_user);
    $add_user->execute(array($_SESSION['id'],"ezeze",$_POST['postdescription']));
    // //print_r($email);
    // //print_r($mdpsec);
   $response=[
       "code"=>"204",
       "message"=>"Post crée avec succès",
       "PostImage"=>"",
       "PostDescription"=>$_POST['postdescription']
   ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);

}


//Fonction pour recuperer tout les post
if(isset($_GET["allPost"])){
    $response= array();

    $allPost = $bdd->prepare('SELECT * FROM post LIMIT 1');
    //var_dump($allPost);
    $allPost->execute();
    // //print_r($email);
    // //print_r($mdpsec);
    $arrayAllPost = array();
    while($row =$allPost->fetchAll())
    {
        $arrayAllPost[] = $row;
    }
   $response=[
       "response"=>$arrayAllPost,
       "code"=>"204",
       "message"=>"Tout les posts"
   ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);

}

function genKey($label,$longueurKey){
    $key = $label;
    for($i=1;$i<$longueurKey;$i++) {
      $key .= mt_rand(1,9);
    }
    return $key;
}


?>