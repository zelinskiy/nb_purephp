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

<p>My Notes</p>





<p> Hello, <span id= "UserNamePlace"></span></p>



<input type="button" id="DeleteAccountButton" value="Delete my Account" ></p>

<input type="button" id="LogoutButton" value="Logout"></p>


<h2>Add note</h2>
<form action="">
	<p><input type="text" id="title"></p>
	<p><textarea id="text" style="width:250px;height:150px;"></textarea></p>
	<p><input type="button" id="AddButton" value="Add"></p>
</form>
<hr>



<div style="display:none;" id = "editForm"  >
<h2  >Edit note</h2>
<form action="" >
	<input type="hidden" id="editId" value = "">
   <p>title: <input type="text" id="editTitleBox"></p>
   <p><textarea id="editTextBox" style="width:250px;height:150px;"></textarea></p>
   <p><input type="button" id="editButton" value="Edit"></p>
</form>
<input type="button" id="CloseEditButton" value="Close Edit"></p>
</div>


<div id="NotesCollection">

</div>






</body>


</html>