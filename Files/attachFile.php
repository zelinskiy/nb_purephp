<?php
if ($_POST["id"]) {
    $id = $_POST["id"];
    $filename = $_FILES["file"]["name"];

    $extension = end(explode(".", $filename));
    $filename = substr($id, 0, -2) . "." . $extension;

    move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] . "/pics/" . $filename);



    echo $filename;
}

?>