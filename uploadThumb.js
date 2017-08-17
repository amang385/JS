function uploadFile() {
    var file_data = $('#file').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    $.ajax({
              url: 'upload_video.php', 
              dataType: 'text', 
              cache: false,
              contentType: false,
              processData: false,
              data: form_data,                         
              type: 'post',
              success: function(php_script_response){
                addPreview(php_script_response);
              }
     });     
}

  function addPreview(file) {
      getThumbnail(file);
  }

function getThumbnail(Filename) {
  var i = 0;
  var video = document.createElement("video");
  var thumbs = document.getElementById("thumbs");

  video.addEventListener('loadeddata', function() {
      i = video.duration/2;
      thumbs.innerHTML = "";
      video.currentTime = i;
  }, false);

  video.addEventListener('seeked', function() {
      generateThumbnail(Filename);
      i++;
    if (!1) { video.currentTime = i; }
    else {}
  }, false);

  video.preload = "auto";
  video.src = '../upload/video/'+Filename;
 

  function generateThumbnail(Filename) {
    var c = document.createElement("canvas");
    var ctx = c.getContext("2d");
    c.width = 160;
    c.height = 90;
    ctx.drawImage(video, 0, 0, 160, 90);
    thumbs.appendChild(c);

    var img = document.getElementById("thumbs");
    var dataURL = c.toDataURL("image/png");

          $.ajax({
            type: "POST",
            url: "upload_img.php",
            data: { 
               imgBase64: dataURL,
               name:Filename
            },success:function(result){
                $("input[name=thumbs_img]").val(result);
                console.log(result);
            }
          }).done(function(o) {
            console.log('save'); 
          });
  }

}