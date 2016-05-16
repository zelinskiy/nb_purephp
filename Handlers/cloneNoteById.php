<?php
session_start();

require_once(realpath(__DIR__.'/..').'/Model/Note.php'); 





$newNote = new Note();

$newNote->Id = $_POST["id"];

$newNote->Fork();

//echo $newNote->Id;



?>

