<?php
include "index.php";
?>


<script>
document.body.innerHTML = '';
</script>

<?php

foreach ($db->users->find() as $user){
	echo $user["login"];
	echo "</br>";
	echo $user["pass"];
	echo "</br>";
	echo "<hr>";
}


?>