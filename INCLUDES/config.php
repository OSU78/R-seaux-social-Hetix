<?php
session_start();
try{
	$bdd = new PDO('mysql:host=localhost;port=3306;dbname=socialmedia','root','');
	//echo "Connection base reuissie";
}
catch( PDOException $e ) {
    echo "Erreur Connexion :", $e->getMessage();
}
?>