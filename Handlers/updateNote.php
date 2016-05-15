<?php

require_once(realpath(__DIR__.'/..').'/Model/Note.php'); 




$newNote = new Note();

$newNote->Id = $_POST["id"];
$newNote->Title = $_POST["title"];
$newNote->Text = $_POST["text"];

$newNote->Date = $_POST["date"];

$newNote->Update();



?>

