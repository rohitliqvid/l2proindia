<?php
$client_id='291574943431-8rsm42l1g8g04ckk52qj9rqft89h0ge5.apps.googleusercontent.com';
$client_secret='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';
$redirectUrl = 'https://l2proindia.com/social-login.php';


$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirectUrl);
$client->addScope('profile');
$client->addScope('email'); 
?>