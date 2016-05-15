<?php
session_start();

require_once 'vendor/autoload.php';

$redirect_uri = 'http://localhost/googleapitest.php';

$client = new Google_Client();

$client->setAuthConfigFile('client_id.json');
$client->setRedirectUri($redirect_uri);

$client->addScope("https://www.googleapis.com/auth/userinfo.profile");
$client->addScope("https://www.googleapis.com/auth/userinfo.email");


$plus = new Google_Service_Plus($client);

echo "Start";

if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();

    echo "Code is set";

    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));

}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
    $_SESSION['token'] = $client->getAccessToken();
    echo $plus->people->get("me")['displayName'];

    $_SESSION["GoogleUser"] = $plus->people->get("me");

    $redirect = 'http://' . $_SERVER['HTTP_HOST'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));

    


} else {
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
}




