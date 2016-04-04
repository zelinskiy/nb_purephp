<?php
session_start();

function deleteUser($id){
	

	$mongo = new Mongo();
	$users = $mongo->mydb->users;
	$users->remove(array(
		"_id" => new MongoId($_SESSION["userid"])
		));
}


deleteUser();



?>

