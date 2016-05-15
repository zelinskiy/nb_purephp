//======POST REQUESTS========

var NotesArray = []



function addNote(title, text){
	$.ajax({
		type: "POST",
		url: 'Handlers/addNote.php',
		data:{
			title:title,
			text:text
		},
		success:function(note_id) {
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



function updateNote(id, title, text){
	$.ajax({
		type: "POST",
		url: 'Handlers/updateNote.php',
		data:{
			id:id,
			title:title,
			text:text			
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
			console.log(h);
		},
		error:function(){
			alert("UserId not set in session");
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


	getUserNotes();
	getUserName();	

	$("#AddButton").click(function(){
		addNote(
			$('#title').val(),
			$('#text').val()
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
			$('#editTextBox').val()
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

	$(document).keyup(function(e) {
	     if (e.keyCode == 27) { 
	     	hideEditForm();
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

		noteDiv.className = "col-sm-3 well";
		


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


		noteEditButton.onclick = function(id, title, text){
			return function(){
				editNote(id, title, text);
			}
		}(mynote["id"],mynote["title"],mynote["text"]);

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




		//====================


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
}




function editNote(id, title, text){
	$("#editForm").css("display", "block");
	$('#editId').val(id);
	$('#editTitleBox').val(title);
	$('#editTextBox').val(text);
}

function hideEditForm(){
	$("#editForm").css("display", "none");
}










function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}









function cloneNote(id){
	var note = NotesArray.filter(function(n){
		return n["id"] == id;
	})[0];
	addNote(note["title"], note["text"]);
}