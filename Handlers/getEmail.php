<?php
session_start();
require_once(realpath(__DIR__.'/..').'/Model/User.php');


if(isset($_SESSION["userid"])){
	echo User::GetUserById($_SESSION["userid"])["email"];
}
else{
	header('HTTP/1.1 400 Bad Request');
}



?>