<?php
session_start();

require_once(realpath(__DIR__.'/..').'/Model/User.php');

User::DeleteUserById($_SESSION["userid"]);


?>

