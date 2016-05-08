<?php
session_start();

if(!isset($_SESSION["userid"])){
	header('Location: login.php');
	exit;
}

?>
<html>
<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">



	<meta charset="utf-8" /> 
	<script src="js/jquery.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<script src="js/notes_page.js"></script>




	<link rel="stylesheet" type="text/css" href="css/notes.css">



</head>
<body>

<p>My Notes</p>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
	<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand">NotaBenes</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li>
				<a id="LogoutButton" >Logout</a>
				</li>
				<li>
				<a id="DeleteAccountButton">Delete my account</a>
				</li>
				
			</ul>
		</div>
	</div>
<!-- /.container -->
</nav>



<div id="HeadJumbotron" class="jumbotron">
	<h1>Nota Benes</h1>
	<p class="lead">Hello, <span id= "UserNamePlace"></p>
</div>



<div id="AddForm" class="panel panel-primary">
	<div class="panel-heading"><h2>Add note</h2></div>
	<div class="panel-body">
	<form action="">
		<p><input class="form-control" type="text" id="title"></p>
		<p><textarea class="form-control" id="text"></textarea></p>

		<p><input class="btn btn-default" type="button" id="AddButton" value="Add"></p>
	</form>

	<form method="post" id="fileUpload">
        <input type="file" name="file" />
    </form>

	</div>
</div>



<div id="editForm" class="well" style="display:none;">
	<div class="panel-heading"><h2>Edit note</h2></div>
	<div class="panel-body">


	<form  action="" >
		<input type="hidden" id="editId" value = "">
		<p><input class="form-control" type="text" id="editTitleBox"></p>
		<p><textarea class="form-control" id="editTextBox"></textarea></p>
		<p>
			<input class="btn btn-default" type="button" id="editButton" value="Edit">
			<input class="btn btn-default" type="button" id="CloseEditButton" value="Close Edit"></p>
		</p>

	</form>


	</div>
</div>





<div class="row" id="NotesCollection">

</div>






</body>


</html>