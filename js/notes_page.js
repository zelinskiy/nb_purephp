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
		success:function() {
			//alert("note added");
			//location.reload();
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
			//alert("note removed");
			//location.reload();
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
			//alert("updated note");
			//location.reload();
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

//======END OF POST REQUESTS========






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




	/*
	$("#text").keypress(function(event){
		if(event.keyCode == 13){
			$("#AddButton").click();
			}
		});

	$("#title").keyup(function(event){
		if(event.keyCode == 13){
			$("#AddButton").click();
			}
		});
	*/

	$("#editTextBox").keyup(function(event){
		if(event.keyCode == 13){
			$("#editButton").click();
			}
		});
	$("#editTextBox").keyup(function(event){
		if(event.keyCode == 13){
			$("#editButton").click();
			}
		});


	$(document).keyup(function(e) {
	     if (e.keyCode == 27) { 
	     	hideEditForm();
	    }
	});



});

















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
		
		//=========================		
		var noteTitleP = document.createElement('p');
		var noteTextP = document.createElement('p');

		noteTitleP.innerHTML = mynote["title"];
		noteTextP.innerHTML = mynote["text"].replace(/\n/g, "<br />");

		noteDiv.appendChild(noteTitleP);
		noteDiv.appendChild(noteTextP);
		//=====================

		var noteDeleteButton = document.createElement('input');
		var noteEditButton = document.createElement('input');

		noteDeleteButton.type = "button";
		noteEditButton.type = "button";

		noteDeleteButton.value = "Delete";
		noteEditButton.value = "Edit";

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

		noteDiv.appendChild(noteDeleteButton);
		noteDiv.appendChild(noteEditButton);

		//=================
		noteDiv.appendChild(document.createElement('hr'));

		root.appendChild(noteDiv);	

	}
}



function clearAddForm(){
	$("#text").val("");
	$("#title").val("");
}




function editNote(id, title, text){
	var form = $("#editForm");
	form.style.display = "block";
	$('#editId').val(id);
	$('#editTitleBox').val(title);
	$('#editTextBox').val(text);
}

function hideEditForm(){
	var form = $("#editForm");
	form.style.display = "none";
}