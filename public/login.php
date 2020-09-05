<?php
//require __DIR__ . '/vendor/autoload.php';

use League\OAuth2\Client\Provider\Google;

session_start(); 
//FACEBOOK
$provider = new \League\OAuth2\Client\Provider\Facebook([
    'clientId'          => '{1165208620545882}',
    'clientSecret'      => '{0c3f115c3e64d15560e413ee8af379e7}',
    'redirectUri'       => 'https://localhost/Autenticacion/public/index.php',
    'graphApiVersion'   => 'v2.10',
]);

if (!isset($_GET['code'])) {

    $authUrl = $provider->getAuthorizationUrl([
        'scope' => ['email', '...', '...'],
    ]);
    $_SESSION['oauth2state'] = $provider->getState();
    
    echo '<a href="'.$authUrl.'">Ingresa con Facebook!</a>';
    exit;

} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    echo 'Invalid state.';
    exit;

}

$token = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
]);

try {

    $user = $provider->getResourceOwner($token);

    printf('Hello %s!', $user->getFirstName());
    
    echo '<pre>';
    var_dump($user);
    echo '</pre>';

} catch (\Exception $e) {

    exit('Oh dear...');
}

echo '<pre>';
var_dump($token->getToken());

var_dump($token->getExpires());
# int(1436825866)
echo '</pre>';

//GOOGLE
$provider = new Google([
    'clientId'     => '{1058436573929-c0o75c26vbgqf3i48cgu6k2qq5ncb4ho.apps.googleusercontent.com}',
    'clientSecret' => '{rblO99jIYERu8GfTqAhAPc6L}',
    'redirectUri'  => 'https://localhost/Autenticacion/public/index.php',
    //'hostedDomain' => 'example.com', 
]);

if (!empty($_GET['error'])) {

   
    exit('Got error: ' . htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'));

} elseif (empty($_GET['code'])) {

    
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;

} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

  
    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    try {

        $ownerDetails = $provider->getResourceOwner($token);

        printf('Hello %s!', $ownerDetails->getFirstName());

    } catch (Exception $e) {

        exit('Something went wrong: ' . $e->getMessage());

    }

    echo $token->getToken();

    echo $token->getRefreshToken();

    echo $token->getExpires();
}
