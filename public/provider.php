<?php

require __DIR__ . '/../vendor/autoload.php';

use League\OAuth2\Client\Provider\Facebook;
use League\OAuth2\Client\Provider\Google;

// Replace these with your token settings
// Create a project at https://console.developers.google.com/
$clientId     = '1165208620545882';
$clientSecret = '0c3f115c3e64d15560e413ee8af379e7';

// Change this if you are not using the built-in PHP server
$redirectUri  = 'http://localhost/Autenticacion/public/ingreso.php';

// Start the session
session_start();

// Initialize the provider
$graphApiVersion  = 'v2.10';
$provider = new Facebook(compact('clientId', 'clientSecret', 'redirectUri', 'graphApiVersion'));

// No HTML for demo, prevents any attempt at XSS
header('Content-Type', 'text/plain');

return $provider;

//use League\OAuth2\Client\Provider\Google;

// Replace these with your token settings
// Create a project at https://console.developers.google.com/
$clientId     = '1058436573929-c0o75c26vbgqf3i48cgu6k2qq5ncb4ho.apps.googleusercontent.com';
$clientSecret = 'rblO99jIYERu8GfTqAhAPc6L';

// Change this if you are not using the built-in PHP server
$redirectUri  = 'http://localhost/Autenticacion/public/user.php';

// Start the session
session_start();

// Initialize the provider
$provider = new Google(compact('clientId', 'clientSecret', 'redirectUri'));

// No HTML for demo, prevents any attempt at XSS
header('Content-Type', 'text/plain');

return $provider;