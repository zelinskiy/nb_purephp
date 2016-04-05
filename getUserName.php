<?php
session_start();

function showUserName(){
	
	$user_id = $_SESSION["userid"];

	$mongo = new Mongo();
	
	$user = $mongo->mydb->users->findOne(array("_id" => new MongoId($user_id)));
	echo $user["login"];

}


showUserName();



?>

