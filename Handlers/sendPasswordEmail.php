<?php

session_start();


require_once(realpath(__DIR__.'/..').'/vendor/pear/mail/Mail.php');

require_once(realpath(__DIR__.'/..').'/Model/User.php');



$user = User::GetUserByName($_POST["username"]);

$username = $_POST["username"];
$userpass = $user["pass"];

$usermail = $user["email"];





$from = 'NotaBenes1@mail.ru';
$to = $usermail;
$subject = 'Hello from NotaBenes!';
$body = "Привет, " . $username . "!\n\n\n".
"Похоже, ты забыл какой у тебя пароль.\nНе беда!\n\n\n".
"К счастью, ты указал свой имейл.\n".
"Вот твой пароль, не забудь его опять: \n".
$userpass.
"\n\nЕсли ты все таки опять его забудешь, можешь снова получить его по почте!";



$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.mail.ru',
        'port' => '465',
        'auth' => true,
        'username' => 'NotaBenes1@mail.ru',
        'password' => 'BenesNota'
    ));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
    echo $mail->getMessage();
} else {
    echo('Email successfully sent!');
}






?>