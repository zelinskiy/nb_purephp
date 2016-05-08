<!DOCTYPE html>
<html>
<head>
    <title>Image Upload Form</title>
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript">
        function submitForm() {
            console.log("submit event");
            var fd = new FormData(document.getElementById("fileinfo"));
            fd.append("id", "100500");
            $.ajax({
              url: "Files/attachFile.php",
              type: "POST",
              data: fd,
              processData: false,  
              contentType: false
            }).done(function( data ) {
                console.log( data );
            });
        }
    </script>
</head>

<body>
    <form method="post" id="fileinfo">
        <input type="file" name="file" />
    </form>

</body>
</html>