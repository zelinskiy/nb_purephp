<?php
session_start();

function deleteUser($id){
	

	$mongo = new Mongo();

	$mongo->mydb->notes->remove(array(
		"user_id" => new MongoId($_SESSION["userid"])
		));
	
	$users = $mongo->mydb->users;
	$users->remove(array(
		"_id" => new MongoId($_SESSION["userid"])
		));
}


deleteUser();



?>

