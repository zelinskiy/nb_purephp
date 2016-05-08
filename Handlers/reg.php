<?php
session_start();

function checkLoginPass($login, $pass){

	$mongo = new Mongo();
	$users = $mongo->mydb->users;
	$user = $users->findOne(array(
		"login" => $login
	));

	if(isset($user)){
		header('HTTP/1.1 400 Bad Request');
	}
	else{
		if(strlen($login) >= 6 || strlen($pass) >= 6){
			$users->insert(array(
			"login" => $login,
			"pass" => $pass
			));
			echo "O.K.";
		}
		else{
			header('HTTP/1.1 400 Short password/login');
		}		
	}
}


checkLoginPass($_POST["login"],$_POST["pass"]);



?>