<?php

//session_start();

function updateNote($id, $title, $text){
	

	$mongo = new Mongo();
	$notes = $mongo->mydb->notes;
	
	$newdata = array(
			"title" => $title,
			"text" => $text
			);


	$notes->update(array("_id" => new MongoId($id)), array('$set' => $newdata));
}

updateNote($_POST["id"],$_POST["title"],$_POST["text"]);



?>

