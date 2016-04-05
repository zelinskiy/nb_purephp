<html>
<head>
	<meta charset="utf-8" /> 
	<script src="jquery.js"></script>
</head>




<body>


<script>

function addNote(title, text){
	$.ajax({
		type: "POST",
		url: 'addNote.php',
		data:{
			title:title,
			text:text
		},
		success:function() {
			alert("note added");
			location.reload();
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
			alert("note removed");
			location.reload();
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
			alert("updated note");
			location.reload();
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


</script>


<p>My Notes</p>

<?php
session_start();

if(!isset($_SESSION["userid"])){
	header('Location: login.php');
	exit;
}

$user_id = $_SESSION["userid"];
$mongo = new Mongo();
$users = $mongo->mydb->users;
$user = $users->findOne(array("_id" => $user_id));

echo "<p>Hello, " . $user["login"] . "</p>";

?>








<input type="button" value="Delete my Account" onclick="deleteAcc()"></p>

<input type="button" value="Logout" onclick="logOut()"></p>


<h2>Add note</h2>
<form action="">
	<p><input type="text" id="title"></p>
	<p><textarea id="text" style="width:250px;height:150px;"></textarea></p>
	<p><input type="button" value="Add" onclick="addNote(document.getElementById('title').value, document.getElementById('text').value)"></p>
</form>
<hr>



<div style="display:none;" id = "editForm"  >
<h2  >Edit note</h2>
<form action="" >
	<input type="hidden" id="editId" value = "">
   <p>title: <input type="text" id="editTitleBox"></p>
   <p><textarea id="editTextBox" style="width:250px;height:150px;"></textarea></p>
   <p><input type="button" value="Edit" onclick="updateNote(document.getElementById('editId').value,document.getElementById('editTitleBox').value, document.getElementById('editTextBox').value)"></p>
</form>
<input type="button" value="Close Edit" onclick="hideEditForm()"></p>
<hr>
</div>


<?php

$mongo = new Mongo();
foreach($mongo->mydb->notes->find(array("user_id" => $user_id)) as $note){




	echo $note["title"];	
	echo "</br>";
	echo $note["_id"];	
	echo "</br>";
	echo $note["text"];
	
	echo '<p><input type="button" value="Remove" onclick="removeNote(';
	echo "'";
	echo $note["_id"];	
	echo "'";
	echo ')"></p>';
	

	echo '<p><input type="button" value="Edit" onclick="editNote(';
	echo "'";
	echo $note["_id"];
	echo "',";
	echo "'";
	echo $note["title"];
	echo "',";
	echo "'";
	echo $note["text"];
	echo "'";
	echo ')"></p>';

	echo "<hr>";

}




?>

</body>


</html>