<?php


/*On recupère les informations de l'utilisateur*/
        $allPost = $bdd->prepare('SELECT * FROM user where id=?');
        //var_dump($allPost);
        $allPost->execute( array(htmlspecialchars($_GET["idReceveur"])));
        $arrayAllPost = array();
      
    $userInfo= $allPost->fetchAll();
    
    
?>