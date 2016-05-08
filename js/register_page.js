function register(login, pass){
	$.ajax({
		type: "POST",
		url: 'Handlers/reg.php',
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






$(document).ready(function() {
	$("#RegisterButton").click(function(){
		register($('#login').val(), $('#pass').val());
		}
	);
});