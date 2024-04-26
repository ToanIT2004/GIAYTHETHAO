$(document).ready(() => {
   // Gửi form đi
   $('#Form_Contact').on('submit', function(event) {
      event.preventDefault();

      fullname = $('#fullname').val();
      email = $('#email').val();
      number_phone = $('#number_phone').val();
      content = $('#content').val();
      
      // Kiểm tra trường hợp trống 
      var mang = ['#fullname', '#email', '#number_phone', '#content'];
      var flag = false;
      mang.forEach(arr => {
         var check = $(arr).val();
         if (check == '') {
            $(arr).addClass('border border-danger')
            flag = true;
         }else {
            $(arr).removeClass('border border-danger')   
         }
      });

      // Kiểm tra số điện thoại 
      if (!/^(0\d{9,10})$/.test(number_phone)) {
         $('#numberphone_error').text('Số điện thoại không hợp lệ');
         flag = true;
      }else {
         $('#numberphone_error').text('');
      }

      // Kiểm tra email
      if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) {
         $('#email_error').text('Email không hợp lệ');
         flag = true;
      } else {
         $('#email_error').text('');
      }

      if(flag == false) {
         $.ajax({
            url: 'Controller/contact.php?act=form_Contact',
            method: 'post',
            data: {
               fullname: fullname,
               email: email,
               number_phone: number_phone,
               content: content
            },
            dataType: 'json',
            success: (res) => {
               if(res.status == 200) {
                  Swal.fire({
                     position: "top-center",
                     icon: "success",
                     title: res.message,
                     showConfirmButton: false,
                     timer: 2500
                  });
                  setTimeout(() => {
                     window.location.reload();
                  }, 2500);
               }
            }
         })
      }
   })

   // Cập nhật trạng thái
   $('.update_status').on('click', function() {
      contact_id = $(this).data('contact_id');
      if(confirm('Bạn muốn thay đổi tình trạng xử lý?')) {
         $.ajax({
            url: 'Controller/Admin/contact.php?act=update_status',
            method: 'POST',
            data: {contact_id: contact_id},
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
                  setTimeout(() => {
                     window.location.reload();
                  }, 1500);
               }
            }
         })
      }
   })

   // Xóa liên hệ
   $('.delete_contact').on('click', function() {
      contact_id = $(this).data('contact_id');
      if(confirm('Bạn có chắc chắn muốn xóa?')) {
         $.ajax({
            url: 'Controller/Admin/contact.php?act=delete_contact',
            method: 'POST',
            data: {contact_id: contact_id},
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
                  setTimeout(() => {
                     window.location.reload();
                  }, 1500);
               }else if(res.status = 403) {
                  Swal.fire(res.message);
               }
            }
         })
      }
   })
})