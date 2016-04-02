<?php

include "index.php";

function addUser($login, $pass){
	global $db;
	$db->users->insert(array(
		"login" => $login,
		"pass" => $pass,
	));

}

if($_POST['action'] == 'call_this') {

	addUser($_POST['login'],$_POST['pass']);
}


?>