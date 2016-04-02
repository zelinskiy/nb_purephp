<?php

include "index.php";

function addNote($user_id, $title, $text){
	global $db;
	$db->notes->insert(array(
		"user_id" => $user_id,
		"title" => $title,
		"text" => $text,
	));

}

if($_POST['action'] == 'call_this') {

	addNote(
		$_POST['user_id'],
		$_POST['title'],
		$_POST['text']
		);
}


?>