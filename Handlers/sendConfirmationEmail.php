<?php

session_start();


require_once(realpath(__DIR__.'/..').'/vendor/pear/mail/Mail.php');

require_once(realpath(__DIR__.'/..').'/Model/User.php');



$user = User::GetUserById($_SESSION["userid"]);

$username = $user["login"];
$userpass = $user["pass"];

User::AssignEmail($_SESSION["userid"], $_POST["email"]);




$from = 'NotaBenes1@mail.ru';
$to = $_POST["email"];
$subject = 'Hello from NotaBenes!';
$body = "Привет, " . $username . "!\n\n\n".
"Ты наверное получил это сообщение 
потому что указал свой имейл в моем сервисе\n\n\n".
"Ну, хоть кто - то им пользуется.
Спасибо тебе!\n\n\n".
"Вот твой пароль, не забудь его:".
$userpass.
"\n\nЕсли ты все таки его забыл, теперь
можешь снова получить его по почте!";



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