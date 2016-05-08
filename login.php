<html>

<head>
	<meta charset="utf-8" /> 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="js/jquery.js"></script>


	<script src="js/login_page.js"></script>
</head>


<h2>Login</h2>
<form action="">
   <p>Login:<input type="text" id="login"></p>
   <p>Password:<input type="text" id="pass"></p>
   <p><input type="button" value="Login" onclick="authorize(document.getElementById('login').value, document.getElementById('pass').value)"></p>
   <p><input type="button" value="Register" onclick="window.location.replace('register.php');"></p>
</form>
<hr>




<?php

session_start();


?>


</html>