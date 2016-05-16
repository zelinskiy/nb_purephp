<?php
session_start();

require_once(realpath(__DIR__).'/Model/User.php');

require_once 'vendor/autoload.php';

$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
//$redirect_uri = 'http://localhost/googleapitest.php';

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

    $me = $plus->people->get("me");
   

    $_SESSION["GoogleUser"] = $me;
    $_SESSION["GoogleUserName"] = $me['displayName'];
    $_SESSION["GoogleUserId"] = $me['id'];

    LoginOrRegister();

    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . "/notes.html";
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));

    


} else {
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
}











function LoginOrRegister(){

    $user = new User();
    $user->Login = $_SESSION["GoogleUserId"];
    $user->Password = $_SESSION["GoogleUserId"];

    if($user->Authorize() || $user->Register()){        
        $_SESSION["userid"] = $user->UserId;
        return True;
    }    
    else{
        return False;
    }
}




