<?php
session_start();
?>

<html>

<head>
	<title>NotaBenes</title>

	<link rel="icon" href="/pictures/favicon.png">

	<meta charset="utf-8" /> 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="/js/jquery.js"></script>

	<script src="/js/login_page.js"></script>



	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="css/login.css">

	<script src="js/bootstrap.js"></script>

	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.css">
</head>


<body>





<div id="LoginForm" class="panel panel-default">

	<div class="panel-heading"><h2>Nota Benes</h2></div>

	<div class="panel-body">
	<form action="">
		<p><input class="form-control" type="text" autocomplete="on" id="login"></p>
		<p><input class="form-control" type="text" autocomplete="on" id="pass"></p>
		<p>
			<input class="btn btn-default" type="button" id="LoginButton" value="Login">
			<input class="btn btn-default" type="button" id="RegisterButton" value="Register">
		</p>
	</form>
	</div>

	<div id="ErrorBox" style="display: none" class="panel-footer">Panel footer</div>
</div>


</body>

</html>