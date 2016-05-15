<html>
<head>
</head>
<body>



<?php

session_start();
$_SESSION["userid"] = 0;
session_destroy();

?>

<script>window.location.replace("login.html");</script>

</body>
</html>