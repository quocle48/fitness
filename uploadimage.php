<?php include_once("application/libraries/config.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include("head.html"); ?>
    <title>Image Upload Form</title>
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript">
        function submitForm() {
            var fd = new FormData(document.getElementById("uploadimage"));
            $.ajax({
              url: "<?php echo $home?>upload.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function(data) {
               $(".imageupload").html("<img style='max-height:300px' src="+data+">");
               $("input[name='urlimage']").val(data);
            });
            return false;
        }
    </script>
</head>
<body>
    <form class="col-xs-4" method="post" id="uploadimage" name="uploadimage">
        <label>Select a image:</label>
        <input type="text" name="urlimage" class="form-control">
        <div class="imageupload"></div>
        <input type="file" name="image" onchange="return submitForm();" required/>  
    </form>
    <div id="output"></div>
</body>
</html>