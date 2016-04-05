<html>

<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="jquery.js"></script>
</head>

<script>

function register(login, pass){
	$.ajax({
		type: "POST",
		url: 'reg.php',
		data:{
			login:login,
			pass:pass
		},
		success:function() {
			alert("Registered successfully");
			window.location.replace("login.php");
		},
		error:function(){
			alert("Login/password incorrect");
		}
	});
}

</script>



<h2>Register</h2>
<form action="">
   <p>Login:<input type="text" id="login"></p>
   <p>Password:<input type="text" id="pass"></p>
   <p><input type="button" value="Register me!" onclick="register(document.getElementById('login').value, document.getElementById('pass').value)"></p>
   <p><input type="button" value="Return to login" onclick="window.location.replace('login.php');"></p>
</form>
<hr>




</html>