<?php

session_start();

require_once(realpath(__DIR__.'/..').'/Model/User.php');

$user = new User();
$user->Login = $_POST["login"];
$user->Password = $_POST["pass"];


if($user->Authorize()){
	$_SESSION["userid"] = $user->UserId;
}
else{
	header('HTTP/1.1 400 Bad Request');
}





?>