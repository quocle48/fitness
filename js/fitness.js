function submitForm() {
  var fd = new FormData(document.getElementById("uploadimage"));
  $.ajax({
    url: "<?php echo $home?>upload.php",
    type: "POST",
    data: fd,
    processData: false,  // tell jQuery not to process the data
    contentType: false   // tell jQuery not to set contentType
  }).done(function(data) {
     $("#uploadimage").html(data);
  });
  return false;
}