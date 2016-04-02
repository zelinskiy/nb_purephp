<html>

<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="scripts.js"></script>
</head>


<body>

<h1>MyNotes</h1>

<script>




</script>

<h2>AddUser</h2>
<form action="">
   <p>Login:<input type="text" id="login"></p>
   <p>Password:<input type="text" id="pass"></p>
   <p><input type="button" value="Add" onclick="addUser(document.getElementById('login').value, document.getElementById('pass').value)"></p>
</form>
<hr>


<h2>AddNote</h2>
<form action="">

	<p>Author: <input type="text" id="noteAuthor"></p>
	<p>Title: <input type="text" id="noteTitle"></p>
	<p><textarea 
		type="text"
		cols="40" 
    	rows="5"
    	id="noteText">
    </textarea>
    </p>
	<p><input type="button" value="Add" onclick="addNote()"></p>

</form>
<hr>


<?php

function onLoad(){
	global $db;
	$mongo = new Mongo();
	$db = $mongo->mydb;
}

onLoad();


foreach ($db->notes->find() as $note){
	echo "Title: ";
	echo $note["title"];
	echo "</br>";
	echo "Text: ";
	echo $note["text"];
	echo "</br>";

	echo "<form action=''>";
	echo '<p><input type="button" value="Remove" onclick="removeNote(';
	echo "'";
	echo$note["_id"];
	echo "'";
	echo ')"></p>';
	echo "</form>";
	echo "</br>";
	echo "<hr>";
}

?>

</body>


</html>