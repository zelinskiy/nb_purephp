<?php
session_start();
require_once(realpath(__DIR__.'/..').'/Model/User.php');


if(isset($_SESSION["GoogleUserName"])){
	echo $_SESSION["GoogleUserName"];
}
else if(isset($_SESSION["userid"])){
	echo User::GetUserNameById($_SESSION["userid"]);
}
else{
	header('HTTP/1.1 400 Bad Request');
}



?>

