function register(login, pass){
	$.ajax({
		type: "POST",
		url: 'Handlers/reg.php',
		data:{
			login:login,
			pass:pass
		},
		success:function(html) {
			succeed();
			setTimeout(redirect, 1000);
			
		},
		error:function(html){
			failed("Login/Password incorrect");
		}
	});
}


function failed(err){
	$("#LoginForm").attr("class", "panel panel-danger");
	$("#ErrorBox").html(err);
	$("#ErrorBox").show();
}

function succeed(){
	$("#LoginForm").attr("class", "panel panel-success");
	$("#ErrorBox").html("Correct");
	$("#ErrorBox").show();
}







$(document).ready(function() {
	$("#RegisterButton").click(function(){
		register($('#login').val(), $('#pass').val());
		}
	);
	$("#ReturnButton").click(function(){
		window.location.replace("login.php");
		}
	);
});