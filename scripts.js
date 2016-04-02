

function addUser(login, pass) {
      $.ajax({
           type: "POST",
           url: 'addUser.php',
           data:{action:'call_this',
           login:login,
           pass:pass,
       		},
           success:function() {
             alert("user added");
           }

      });
 }



 function addNote() {
	$.ajax({
		type: "POST",
		url: 'addNote.php',
		data:{action:'call_this',
			author:document.getElementById('noteAuthor').value,
			title:document.getElementById('noteTitle').value,
			text:document.getElementById('noteText').value,		

			},
		success:function() {
		 alert("note added");
		}
	});
 }


function removeNote(id) {
	$.ajax({
		type: "POST",
		url: 'removeNote.php',
		data:{
			action:'call_this',
			note_id:id,
		},
		success:function() {
			alert("note " + id +  " removed");
		}
	});
}