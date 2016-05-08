<?php
session_start();

if(!isset($_SESSION["userid"])){
	header('Location: login.php');
	exit;
}

?>
<html>
<head>
	<meta charset="utf-8" /> 
	<script src="js/jquery.js"></script>

	<script src="js/notes_page.js"></script>

	<style type="text/css">
		
		#editForm{
		padding-left:5000px;
		padding-right:5000px;
		padding-bottom:5000px;
		position: fixed;
		top: 0%;
		transform: translateY(-50%);
		left: 50%;
		transform: translateX(-50%);

		background:rgba(200,200,100, 0.7);
		z-index:100;
		}

	</style>
</head>




<body>


<script>















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
</div>


<div id="NotesCollection">

</div>






</body>


</html>