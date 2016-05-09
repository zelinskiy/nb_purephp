<?php

//session_save_path("/tmp");
session_start();



function checkLoginPass($login, $pass){
	$mongo = new Mongo();
	$users = $mongo->mydb->users;
	$user = $users->findOne(array(
		"login" => $login,
		"pass" => $pass,
	));

	if(isset($user)){
		$_SESSION["userid"] = $user["_id"];
	}
	else{
		header('HTTP/1.1 400 Bad Request');
	}
}


checkLoginPass($_POST["login"],$_POST["pass"]);


?>