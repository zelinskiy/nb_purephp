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