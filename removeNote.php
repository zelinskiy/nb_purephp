<?php

include "index.php";

function removeNote($note_id){
	global $db;
	$db->notes->remove(
		array('_id' => new MongoId($note_id))
		);

}

if($_POST['action'] == 'call_this') {

	removeNote($_POST['note_id']);
}


?>