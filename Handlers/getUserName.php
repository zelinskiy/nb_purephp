<?php
session_start();
require_once(realpath(__DIR__.'/..').'/Model/User.php');


$user_id = $_SESSION["userid"];

echo User::GetUserNameById($user_id);




?>

