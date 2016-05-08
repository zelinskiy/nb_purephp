<?php

function removeNote($id){
	

	$mongo = new Mongo();
	$notes = $mongo->mydb->notes;
	$notes->remove(array(
		"_id" => new MongoId($id)
		));
}


removeNote($_POST["id"]);



?>

