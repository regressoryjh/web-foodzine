<?php
require_once 'vendor/autoload.php';

$clientID = '721517068826-00vdnur0kn6pjv5k1s1tm7mpo2qv2433.apps.googleusercontent.com';
$clientSecret = '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';
$redirectURI = 'http://localhost/imk/login.php';

// CREATE CLIENT REQUEST TO GOOGLE
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectURI);
$client->addScope('profile');
$client->addScope('email');