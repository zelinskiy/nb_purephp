<?php
session_start();

require_once(realpath(__DIR__.'/..').'/Model/Note.php'); 


$newNote = new Note();

$newNote->UserId = $_SESSION["userid"];


echo $newNote->GetNotesJSON();




?>

