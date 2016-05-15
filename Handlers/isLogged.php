<?php
session_start();


if(isset($_SESSION["userid"])){
	echo $_SESSION["userid"];
}
else{
	header('HTTP/1.1 400 Bad Request');
}





?>

