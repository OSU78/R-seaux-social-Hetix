<?php
/*fUNCTION QUI PERMET DE FAIRE L'UPLOAD DE FICHIER */
function uploadImage($array,$id,$emplacement){
    //Verif de la taille du fichier

    $maxsize = 9097152; //8Mo 8097152
    if(($array['size'] <= $maxsize)){

$image_name=$id.".".date('Y-m-d-H-i-s');
$filename=$array['name'];
$temp_array=explode(".",$filename);/*permet de transformer une chaine de caractere en tableau*/
$extension=explode("/",$array["type"])[1];/*on prend le dernier element du tableau avec end*/
$chemin_image=$emplacement."/".$image_name.'.'.$extension;
$nomImage=$image_name.'.'.$extension;
/*Deplacement du fichier uploader vers son emplacement final*/
move_uploaded_file($array['tmp_name'] , $chemin_image);
return $array=[
    "cheminComplet"=>$chemin_image,
    "nomImage"=>$nomImage
];

}

}
