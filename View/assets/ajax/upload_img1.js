$('#upload_img1').on('click', function() {
   // Lấy ra files
   var file_data = $('#img1').prop('files')[0];
   if(!file_data || file_data.length === 0){
      Swal.fire("Vui lòng chọn tệp");return;
   }

   // Lấy ra kiểu file
   var type = file_data.type;
   var match = ["image/gif", "image/png", "image/jpg","image/jpeg", "image/webp"];
   if(type == match[0] || type == match[1] || type == match[2] || type == match[3] || type[4]) {
      var form_data = new FormData();
      form_data.append('file1', file_data)
      $.ajax({
         url: 'Model/upload_img1.php',
         contentType: false,
         processData: false,
         data: form_data,    
         type: 'post',
         success: function(res) {
            var data = JSON.parse(res);
            if(data.status == 200) {
               $('#preview_img1').attr('src', data.data);
            }
         }
      })
   }
})