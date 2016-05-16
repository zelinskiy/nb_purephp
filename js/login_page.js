function authorize(login, pass){
	$.ajax({
		type: "POST",
		url: 'Handlers/authorize.php',
		data:{
			login:login,
			pass:pass
		},
		success:function(html) {
			succeed();
			setTimeout(redirect, 500);
			
		},
		error:function(){
			failed("Fail to login");
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


function redirect(){
	window.location.replace("notes.html");
}



$(document).ready(function() {


	$("#LoginButton").click(function(){
		authorize($('#login').val(), $('#pass').val());
		}
	);

	$("#RegisterButton").click(function(){
		window.location.replace('register.html');
		}
	);
});



function checkUserIdSessionSet(){
	$.ajax({
		type: "POST",
		url: 'Handlers/isLogged.php',
		data:{		
		},
		success:function(h) {
			window.location.replace("notes.html");
		},
		error:function(){
		}
	});
}





$(document).ready(function() {
	checkUserIdSessionSet();

});







function authorizeGoogle(){
	window.location.replace("/googleapitest.php");
}

