<html>
<head>
	<meta charset="utf-8" /> 
	<script src="jquery.js"></script>

	<style type="text/css">
		
		#editForm{
		padding:150px;
		position: fixed;
		top: 20%;
		transform: translateY(-50%);
		left: 50%;
		transform: translateX(-50%);
		margin-left: -100px;
		margin-top: -100px;
		background-color: #D1D1D1;
		z-index:100;
		}

	</style>
</head>




<body>


<script>






//======POST REQUESTS========

var NotesArray = []



function addNote(title, text){
	$.ajax({
		type: "POST",
		url: 'addNote.php',
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
		url: 'removeNote.php',
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
		url: 'updateNote.php',
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
		url: 'deleteUser.php',
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
		url: 'getUserNotes.php',
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
		url: 'getUserName.php',
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
	document.getElementById("text").value = "";
	document.getElementById("title").value = "";
}




function editNote(id, title, text){
	var form = document.getElementById("editForm");
	form.style.display = "block";
	document.getElementById('editId').value = id;
	document.getElementById('editTitleBox').value = title;
	document.getElementById('editTextBox').value = text;
}

function hideEditForm(){
	var form = document.getElementById("editForm");
	form.style.display = "none";
}


function bindEventsOnKeys(){
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


}


function onStart(){
	getUserNotes();
	getUserName();
	bindEventsOnKeys();
	
}

onStart()

</script>


<p>My Notes</p>

<?php
session_start();

if(!isset($_SESSION["userid"])){
	header('Location: login.php');
	exit;
}

?>



<p> Helo, <span id= "UserNamePlace"></span></p>



<input type="button" value="Delete my Account" onclick="deleteAcc()"></p>

<input type="button" value="Logout" onclick="logOut()"></p>


<h2>Add note</h2>
<form action="">
	<p><input type="text" id="title"></p>
	<p><textarea id="text" style="width:250px;height:150px;"></textarea></p>
	<p><input type="button" id="AddButton" value="Add" onclick="addNote(document.getElementById('title').value, document.getElementById('text').value)"></p>
</form>
<hr>



<div style="display:none;" id = "editForm"  >
<h2  >Edit note</h2>
<form action="" >
	<input type="hidden" id="editId" value = "">
   <p>title: <input type="text" id="editTitleBox"></p>
   <p><textarea id="editTextBox" style="width:250px;height:150px;"></textarea></p>
   <p><input type="button" id="editButton" value="Edit" onclick="updateNote(document.getElementById('editId').value,document.getElementById('editTitleBox').value, document.getElementById('editTextBox').value)"></p>
</form>
<input type="button" value="Close Edit" onclick="hideEditForm()"></p>
<hr>
</div>


<div id="NotesCollection">

</div>






</body>


</html>