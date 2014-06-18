<?php

session_start();

/* ***********************************************
 * Authorization
 *
 * We're here because we don't have a session
 * authorization toeken
 * ***********************************************/

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
$authUrl = $client->createAuthUrl();



/*
 * this means we've gotten back a response
 */
if ( isset( $_GET['code'] ) ) {
  $client->authenticate( $_GET['code'] );
  $_SESSION['access_token'] = $client->getAccessToken();

  $redirect = 'http://' . $_SERVER['HTTP_HOST'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));

} else {

  echo '<a href="'.$authUrl.'">Go</a><br><br>';
  echo '<a href="/clear_session.php">Clear</a><br><br>';
  echo '<p>No problems here...<br>';

}

var_dump($_SESSION);
