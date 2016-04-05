<html>
<head>
	
</head>


<body>


<?php


echo "Admin panel";
echo "<hr>";

$mongo = new Mongo();
$notes = $mongo->mydb->notes;
$users = $mongo->mydb->users->find();



foreach($users as $user){
	echo "<h3>Username / Password</h3>";
	echo "<p>";
	echo $user["login"];
	echo " / ";
	echo $user["pass"];
	echo "</p>";
	//echo "<hr>";
	echo "<h4>Notes: </h4>";


	$mynotes = $notes->find(array(
		"user_id" => $user["_id"]
		));

	foreach ($mynotes as $note){
		echo "<p>";
		echo $note["title"];
		echo "   ===>   ";
		echo $note["text"];
		echo "</p>";
		//echo "<hr>";
	}
	echo "<hr><hr>";
}





?>



</body>


</html>
