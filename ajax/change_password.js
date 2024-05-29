$(document).ready(() => {
   // Hiện thị mật khẩu
   $(document).on('click', '#show_password', function () {
      $('#password_old').val();
      $('#password_new').val();
      $('#confirm_password_new').val();
      var inputType1 = $('#password_old').attr('type');
      var inputType2 = $('#password_new').attr('type');
      var inputType3 = $('#confirm_password_new').attr('type');
      (inputType1 === 'password') ? $('#password_old').attr('type', 'text') : $('#password_old').attr('type', 'password');
      (inputType2 === 'password') ? $('#password_new').attr('type', 'text') : $('#password_new').attr('type', 'password');
      (inputType3 === 'password') ? $('#confirm_password_new').attr('type', 'text') : $('#confirm_password_new').attr('type', 'password');
   })

   $(document).on('submit', '#form_change_password', function(event) {
      event.preventDefault();
      // Kiểm tra trống
      result_empty = check_empty('#password_old', '#password_new', '#confirm_password_new');

      user_id = $('#user_id').val();
      if(result_empty == false) { 
         
         var form_change_password = new FormData(this)

         $.ajax({
            url: 'Controller/change_password.php?act=update_password',
            method: 'POST',
            data: form_change_password,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (res) => {
               if(res.status == 200) {
                  Swal.fire({
                     position: "top-center",
                     icon: "success",
                     title: res.message,
                     showConfirmButton: false,
                     timer: 1500
                  });
               }else if(res.status == 404) {
                  $('#password_old_error').text(res.message)
               }else if(res.status == 403) {
                  $('#password_new_error').text(res.message)
               }else {
                  Swal.fire({
                     icon: "error",
                     title: "Trùng...",
                     text: res.message,
                   });
               }
            },error: (error) => console.log(error)
         })
      }
   })
})