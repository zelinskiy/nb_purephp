<?php
session_start();

if(!isset($_SESSION["userid"])){
	header('Location: login.php');
	exit;
}

?>
<html>
<head>
	<title>NotaBenes</title>
	<link rel="icon" href="/pictures/favicon.png">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">



	<meta charset="utf-8" /> 
	<script src="/js/jquery.js"></script>


	<!--script src="js/bootstrap.js"></script-->

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<script src="/js/notes_page.js"></script>




	<link rel="stylesheet" type="text/css" href="css/notes.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.css">



</head>
<body>



<div id="ActiveButton" class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle glyphicon glyphicon-menu-hamburger " 
  	data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
  <ul class="dropdown-menu dropdown-menu-right">
  	<li><a>Hello, <span id = "UserNamePlace"></span></a></li>
  	<li role="separator" class="divider"></li>
    <li><a id="DeleteAccountButton" >Delete my account</a></li>
    <li><a id="LogoutButton" >Logout</a></li>
  </ul>
</div>



<div id="AddForm" class="panel panel-default ">
	<div class="panel-heading nounderline">		
		<div class="dropdown" >			
			<button id="TogglePatternButton" type="button" class="pull-right btn btn-default dropdown-toggle glyphicon glyphicon-menu-hamburger " 
			data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
			</button>
			<ul class="pull-right dropdown-menu" aria-labelledby="dropdownMenu1">
				<li><a id="LoadRecipeButton">Recipe</a></li>
				<li><a id="LoadMeetingButton">Meeting</a></li>
				<li><a id="LoadContactButton">Contact</a></li>
			</ul>
		</div>
		<button id = "AddCheckboxToAddTextButton" class="btn btn-default glyphicon glyphicon-ok"></button>
		<h2>Add note</h2>

	</div>
	<div class="panel-body">
	<form action="">
		<p><input class="form-control" type="text" id="title" autocomplete="off"></p>
		<p><textarea class="form-control" id="text"></textarea></p>

		<p><input class="btn btn-default " type="button" id="AddButton" value="Add"></p>
	</form>

	</div>
</div>


<div id="NotePatterns" style="display:none;">
	<div class="well" style="width:300px;">
		
<div id = "NotePatternRecipe">Description:



Ingredients:



Directions:


Notes:


</div>


<div id = "NotePatternMeeting">When:

Where:

Who:

Notes:

</div>


<div id = "NotePatternContact">Full Name:

Phone:

Email:

Notes:

</div>



	</div>

</div>






<div id="editForm" class="well" style="display:none;">
	<div class="panel-heading"><h2>Edit note</h2></div>
	<div class="panel-body">


	<form  action="" >
		<input type="hidden" id="editId" value = "">
		<p><input class="form-control" type="text" id="editTitleBox" autocomplete="off"></p>
		<p><textarea class="form-control" id="editTextBox"></textarea></p>
		<p>
			<input class="btn btn-default" type="button" id="editButton" value="Edit">
			<input class="btn btn-default" type="button" id="CloseEditButton" value="Close Edit">

			<button type="button" id = "AddCheckboxToEditTextButton" class="pull-right btn btn-default glyphicon glyphicon-ok"></button>
		</p>

	</form>


	</div>
</div>





<div class="row" id="NotesCollection">

</div>












</body>


</html>