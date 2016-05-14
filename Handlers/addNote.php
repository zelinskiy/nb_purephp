<?php
session_start();

require_once(realpath(__DIR__.'/..').'/Model/Note.php'); 





$newNote = new Note();

$newNote->Title = $_POST["title"];
$newNote->Text = $_POST["text"];
$newNote->UserId = $_SESSION["userid"];

$newNote->Add();

echo $newNote->Id;



?>

