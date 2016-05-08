<?php
session_start();

function insertNote($title, $text){
	
	$user_id = $_SESSION["userid"];

	$mongo = new Mongo();
	$notes = $mongo->mydb->notes;

	$data = array(
		"user_id" => $user_id,
		"title" => $title,
		"text" => $text
		);

	$notes->insert($data);

	echo $data["_id"];
}


insertNote($_POST["title"], $_POST["text"]);



?>

