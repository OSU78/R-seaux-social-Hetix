<?php
require_once 'vendor/autoload.php';
$client = new Google_Client();
$client->authenticate($_GET['code']);
$access_token = $client->getAccessToken();
if(isset($_GET["code"])){

    echo $access_token;
}