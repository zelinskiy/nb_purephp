function authorize(login, pass){
	$.ajax({
		type: "POST",
		url: 'Handlers/authorize.php',
		data:{
			login:login,
			pass:pass
		},
		success:function(html) {
			alert("logged");
			window.location.replace("notes.php");
		},
		error:function(){
			alert("fail to login");
		}
	});
}




$(document).ready(function() {
	$("#LoginButton").click(function(){
		authorize($('#login').val(), $('#pass').val());
		}
	);

	$("#RegisterButton").click(function(){
		window.location.replace('register.php');
		}
	);
});