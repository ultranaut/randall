<?php

session_start();
/*
 * if we don't already have an access token, go get one
 */
if ( !isset( $_SESSION['access_token'] ) ) {
  header( 'Location: oauth2.php' );
} else {
}

/* https://developers.google.com/api-client-library/php/start/installation */
include 'vendor/autoload.php';

include 'credentials.php';

/*
 * set up a Client object
 */
$client = new Google_Client();
$client->setClientId( CLIENT_ID );
$client->setClientSecret( CLIENT_SECRET );
$client->setRedirectUri( REDIRECT_URI );
$client->setScopes( SCOPES );
$client->setAccessToken( $_SESSION['access_token'] );
var_dump($client);
echo '<br><br>Looks like I\'m golden...';
