<?php

require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setAuthConfig('client_secret.json');
$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
$client->setRedirectUri('http://localhost/php-HETIC/HETIX/googleAuth/connect.php');
// offline access will give you both an access and refresh token so that
// your app can refresh the access token without user interaction.
$client->setAccessType('online');
// Using "consent" ensures that your application always receives a refresh token.
// If you are not using offline access, you can omit this.

$client->setIncludeGrantedScopes(true);   // incremental auth

$auth_url = $client->createAuthUrl();
require_once("configGoogle.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="<?=$auth_url?>">Se connecter Google</a>
</body>
</html>
