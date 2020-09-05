<?php

$provider = require __DIR__ . '/provider.php';

if (isset($_GET['logout']) && $_GET['logout'] = 1) {
    unset($_SESSION['token']);
}

if (!empty($_SESSION['token'])) {
    $token = unserialize($_SESSION['token']);
}

if (empty($token)) {
    header('Location: /');
    exit;
}

try {
    $userDetails = $provider->getResourceOwner($token);

    printf('Hello %s!<br/>', $userDetails->getFirstname());
} catch (Exception $e) {
    exit('Something went wrong: ' . $e->getMessage());
}

echo "Token is: <tt>", $token->getToken(), "</tt><br/>";

echo "Refresh token is: <tt>", $token->getRefreshToken(), "</tt><br/>";

echo "Expires at ", date('r', $token->getExpires()), "<br/>";

echo '<a href="?logout=1">Logout</a><br/>';