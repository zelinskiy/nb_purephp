//======POST REQUESTS========

var NotesArray = []

var currentCoords = "";
var currentStreet = "";




function addNote(title, text, date){
	$.ajax({
		type: "POST",
		url: 'Handlers/addNote.php',
		data:{
			title:title,
			text:text,
			date:date,
			located:currentCoords +"&"+currentStreet
		},
		success:function(note_id) {
			console.log(currentCoords +"&"+currentStreet);
			clearAddForm();
			getUserNotes();
		},
		error:function(){
			alert("failed to add note");
		}
	});
}





function removeNote(id){
	$.ajax({
		type: "POST",
		url: 'Handlers/removeNote.php',
		data:{
			id:id
		},
		success:function() {
			getUserNotes();
		},
		error:function(){
			alert("failed to remove note");
		}
	});
}



function updateNote(id, title, text, date){
	$.ajax({
		type: "POST",
		url: 'Handlers/updateNote.php',
		data:{
			id:id,
			title:title,
			text:text,
			date:date,
		},
		success:function() {
			hideEditForm();
			getUserNotes();
		},
		error:function(){
			alert("failed to update note");
		}
	});
}



function logOut(){
	window.location.replace("logout.php");
}


function deleteAcc(){
	$.ajax({
		type: "POST",
		url: 'Handlers/deleteUser.php',
		data:{		
		},
		success:function() {
			alert("Your account deleted");
			logOut();
		},
		error:function(){
			alert("failed to delete your acc");
		}
	});
}


function getUserNotes(){
	$.ajax({
		type: "POST",
		url: 'Handlers/getUserNotes.php',
		data:{		
		},
		success:function(h) {
			NotesArray = JSON.parse(h);
			showNotes();
		},
		error:function(){
			alert("failed to get your notes");
		}
	});
}


function getUserName(){
	$.ajax({
		type: "POST",
		url: 'Handlers/getUserName.php',
		data:{		
		},
		success:function(h) {
			console.log(h);
			showUserName(h);
		},
		error:function(){
			alert("failed to get your name");
		}
	});
}

function checkUserIdSessionSet(){
	$.ajax({
		type: "POST",
		url: 'Handlers/isLogged.php',
		data:{		
		},
		success:function(h) {
		},
		error:function(h){
			window.location.replace("login.html");
		}
	});
}




//======END OF POST REQUESTS========



$(document).load(
	function(){
		checkUserIdSessionSet();
	}
);



$(document).ready(function() {

	checkUserIdSessionSet();

	getUserNotes();
	getUserName();

	
	

	$("#AddButton").click(function(){
		addNote(
			$('#title').val(),
			$('#text').val(),
			$('#NoteDatePicker').val()
			);
		}
	);


	$("#AddCheckboxToAddTextButton").click(function(){
		insertTxtAtCursor("text", "<uch>");
		}
	);

	$("#AddCheckboxToEditTextButton").click(function(){
		insertTxtAtCursor("editTextBox", "<uch>");
		}
	);




	$("#editButton").click(function(){
		updateNote(
			$('#editId').val(),
			$('#editTitleBox').val(),
			$('#editTextBox').val(),
			$('#EditNoteDatePicker').val()
			);
		}
	);

	
	$("#CloseEditButton").click(function(){
		hideEditForm();
		}
	);

	$("#DeleteAccountButton").click(function(){
		deleteAcc();
		}
	);

	$("#LogoutButton").click(function(){
		logOut();
		}
	);

	$("#LoadRecipeButton").click(function(){
		loadPattern("NotePatternRecipe");
		}
	);

	$("#LoadMeetingButton").click(function(){
		loadPattern("NotePatternMeeting");
		}
	);

	$("#LoadContactButton").click(function(){
		loadPattern("NotePatternContact");
		}
	);


	$("#ToggleRowsColsButton").click(function(){
		toggleRowsCols();
		}
	);

	toggleRowsCols();



	$("#NoteLocationPickerButton").click(function(){
		$('#NoteLocationPicker').toggle();
		}
	);


	window.setTimeout(function(){$('#NoteLocationPicker').toggle()}, 500);



	$("#SetEmailButton").click(function(){
		setEmail();
	});



	$("#GetEmailButton").click(function(){
		getEmail();
	});




	$(document).keyup(function(e) {
	     if (e.keyCode == 27) { 
	     	hideEditForm();
	    }
	});





	$('#NoteLocationPicker').locationpicker({
		location: {latitude: 50.015209, longitude: 36.228303},
		radius: 300,
		onchanged: function (currentLocation, radius, isMarkerDropped) {
			var addressComponents = $(this).locationpicker('map').location.addressComponents;

			currentCoords = currentLocation.latitude +"|"+ currentLocation.longitude; 
			currentStreet =  addressComponents.addressLine1;

			$("#SelectedStreetPlaceholder").html(currentStreet);
			
		}
	});












});




function funcText(i, j){
	return " onclick = \'replaceChUch(" + i + "," + j + ")\'/>";
}




function replaceHtmlCheckbox(input, i){
	var uncheckedText = '<input type="checkbox" id="uch"';
	var checkedText = '<input type="checkbox" checked id="ch"';



	var lines = input.split('\n').filter(function(s){
			return s.indexOf("<uch>") > -1 || s.indexOf("<ch>") > -1;
		});

	for(var j = 0; j<lines.length; j++){
		line = lines[j];
		oldline = line;

		line = line
				.replace("<uch>",uncheckedText + funcText(i, j))
				.replace("<ch>",checkedText + funcText(i, j));

		input = input.replace(oldline, line);
	}

	return input.replace(/\n/g, "<br/>");

}




function replaceChUch(i, j){
	var note = NotesArray[i];
	var text = note["text"];

	var lines = text.split('\n').filter(function(s){
			return s.indexOf("<uch>") > -1 || s.indexOf("<ch>") > -1;
		});

	line = lines[j];
	oldline = line;

	if(line.indexOf("<uch>") > -1){
		line = line.replace("<uch>","<ch>");
	}
	else{
		line = line.replace("<ch>","<uch>");
	}
	

	text = text.replace(oldline, line);
	updateNote(note["id"], note["title"], text);

	
}






function insertTxtAtCursor(textareaId, txt){
    var caretPos = document.getElementById(textareaId).selectionStart;
    var textAreaTxt = $("#"+textareaId).val();
    $("#"+textareaId).val(textAreaTxt.substring(0, caretPos) + txt + textAreaTxt.substring(caretPos) );
}







function loadPattern(id){
	var pattern = $("#"+id).html();

	$("#text").html(pattern);

}



//Binds username to DOM element
function showUserName(name){
	var nameHolder = document.getElementById("UserNamePlace");
	nameHolder.innerHTML = name;
}



//Building DOM from notes array
function showNotes(){

	var A = NotesArray;

	var root = document.getElementById("NotesCollection");

	root.innerHTML = "";

	for(i=A.length-1; i>=0; i--){		

		var mynote = A[i];

		var noteDiv = document.createElement('div');
		noteDiv.id = mynote["id"];

		noteDiv.className = "col-sm-3 well "+getNotificationClass(mynote["date"]);


		


		//==============Text===========		
		var noteTitleP = document.createElement('p');
		var noteTextP = document.createElement('p');


		noteTitleP.innerHTML = mynote["title"];
		if(mynote["text"]){
			noteTextP.innerHTML = replaceHtmlCheckbox(mynote["text"], i);
		}
		

		noteDiv.appendChild(noteTitleP);
		noteDiv.appendChild(document.createElement("hr"));
		noteDiv.appendChild(noteTextP);
		noteDiv.appendChild(document.createElement("br"));


		//==========================


		var noteDateP = document.createElement('span');
		noteDateP.className = "pull-right";

		if(mynote["date"]){
			mynote["date"]= mynote["date"].replace("undefined", "");
		}


		
		noteDateP.innerHTML = mynote["date"];
		noteDiv.appendChild(noteDateP);

		if(mynote["located"]){
			mynote["located"]= mynote["located"].replace("undefined", "");
		}
		else{
			mynote["located"]="";
		}
		var noteLocatedP = document.createElement('span');
		noteLocatedP.innerHTML = mynote["located"].split("&")[1];
		noteDiv.appendChild(noteLocatedP);


		
		noteDiv.appendChild(document.createElement("br"));
		noteDiv.appendChild(document.createElement("br"));

		//===========Butttons==========

		var noteDeleteButton = document.createElement('input');
		var noteEditButton = document.createElement('input');

		noteDeleteButton.type = "button";
		noteEditButton.type = "button";

		noteDeleteButton.value = "Delete";
		noteEditButton.value = "Edit";

		noteEditButton.className = "btn btn-default";
		noteDeleteButton.className = "pull-right btn btn-default";

		noteDeleteButton.onclick = function(id){
			return function(){
				removeNote(id);
			}
		}(mynote["id"]);


		

		noteEditButton.onclick = function(id, title, text, date){
			return function(){
				editNote(id, title, text, date);
			}
		}(mynote["id"],mynote["title"],mynote["text"], mynote["date"]);

		noteDiv.appendChild(noteEditButton);
		noteDiv.appendChild(noteDeleteButton);
		

		//=================

		var noteCopyButton = document.createElement('input');

		noteCopyButton.type = "button";

		noteCopyButton.value = "Fork";

		noteCopyButton.className = "pull-right btn btn-default ";

		noteCopyButton.onclick = function(id){
			return function(){
				cloneNote(id);
			}
		}(mynote["id"]);



		noteDiv.appendChild(noteCopyButton);



		//=================


		if(mynote["located"].length > 5){
			var noteMapLocationButton = document.createElement('a');

			noteMapLocationButton.href = "http://maps.google.com/?q=" + mynote["located"].replace("|",",").split("&")[0];

			noteMapLocationButton.target="_blank"

			noteMapLocationButton.value = "Map";

			noteMapLocationButton.className = "pull-right btn btn-default glyphicon glyphicon-map-marker";

			noteDiv.appendChild(noteMapLocationButton);

		}
		
		



		

		

		//===========================


		root.appendChild(noteDiv);	

	}
}



function imgExist(url) 
{
	var http = new XMLHttpRequest();

	http.open('HEAD', url, false);
	http.send();

	return http.status != 404;

}



function clearAddForm(){
	$("#text").val("");
	$("#title").val("");
	$("#NoteDatePicker").val("");
	currentStreet="";
	currentLocation="";
	$("#SelectedStreetPlaceholder").html("");
}




function editNote(id, title, text, date){
	$("#editForm").show();
	$('#editId').val(id);
	$('#editTitleBox').val(title);
	$('#editTextBox').val(text);
	$('#EditNoteDatePicker').val(date);
	

}

function hideEditForm(){
	$("#editForm").hide();
}










function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}



function toggleRowsCols(){
	$("#NotesCollection").toggleClass("col-md-3");
}




function cloneNote(id){

	$.ajax({
		type: "POST",
		url: 'Handlers/cloneNoteById.php',
		data:{
			id:id
		},
		success:function() {
			getUserNotes();
		},
		error:function(){
			alert("failed to clone note");
		}
	});


}




function getNotificationClass(noteDate){
	var noteDate = new Date(noteDate);
	var nowDate = Date.now();

	var diff = noteDate - nowDate; 
    var days = Math.floor( diff / 86400000)

    if(days == -1){
    	return "todayWell";
    }
    else if(days == 0){
    	return "tomorrowWell";
    }
    else if(days < -1){
    	return "lateWell";
    }
    else if(days > 0 && days < 7){
    	return "thisweekWell";
    }
    else{
    	return "";
    }	
}



function getEmail(){
	$.ajax({
		type: "POST",
		url: 'Handlers/getEmail.php',
		data:{
		},
		success:function(h) {
			alert(h);
		},
		error:function(){
			alert("failed to send confirmation email");
		}
	});
}


















function setEmail(){
	var inp = prompt("Email:", "");
	if(inp.length > 3){
		sendConfirmationEmail();
	}
	
}



function sendConfirmationEmail(email){
	$.ajax({
		type: "POST",
		url: 'Handlers/sendConfirmationEmail.php',
		data:{
			email:email
		},
		success:function(h) {
			alert(h);
		},
		error:function(){
			alert("failed to send confirmation email");
		}
	});
}





