<?php
session_start();

function showJSONnotes(){
	
	$user_id = $_SESSION["userid"];

	$mongo = new Mongo();
	$notes = $mongo->mydb->notes;
	$mynotes = $notes->find(array(
		"user_id" => $user_id
		));

	$json = array();
	foreach ($mynotes as $note) {
		array_push($json, array(
			"id" => $note["_id"]->{'$id'},
			"title" => $note["title"],
			"text" => $note["text"]
			));
	}
	echo json_encode($json);

}


showJSONnotes();



?>

