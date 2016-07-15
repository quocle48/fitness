var base_url = window.location.origin;
function submitForm() {
    var fd = new FormData(document.getElementById("uploadimage"));
    $.ajax({
      url: base_url+"/upload.php",
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