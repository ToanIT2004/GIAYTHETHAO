$(document).ready(() => {
   // Register Nguời dùng
   $(document).on('submit', '#register', (event)=> {
      event.preventDefault(); // Ngăn chặn mặc định của thẻ form
      // Xử lý tên trống 
      var mang = ['#firstname', '#lastname', '#email', '#password', '#confirm_password'];
      var flag = false;
      mang.forEach(arr => {
         var check = $(arr).val();
         if (check.trim() === '') {
            $(arr).addClass('border border-danger')
            flag = true;
         } else {
            $(arr).removeClass('border border-danger')   
         }
      });

      // Xử lý tên không được nhập số và ký tự đặc biệt
      var digitPattern = /\d/; // Biểu thức chính quy để kiểm tra xem chuỗi có chứa ít nhất một số không
      var specialCharPattern = /[~!@#$%^&*()_+`\-={}[\]:;"'<>,.?/\\|]/; // Biểu thức chính quy để kiểm tra xem chuỗi có chứa ký tự đặc biệt hay không
      var firstname = $(mang[0]).val();
      var lastname = $(mang[1]).val();

      if (digitPattern.test(firstname) || digitPattern.test(lastname)) {
         $('#firstname_error').text('Họ tên không được chứa số');
         flag = true;
      } else if (specialCharPattern.test(firstname) || specialCharPattern.test(lastname)) {
         $('#firstname_error').text('Họ tên không được chứa ký tự đặc biệt');
         flag = true;
      } else {
         $('#firstname_error').text('');
      }


      specialCharPattern = /[`~!@#$%^&*()_+]/;
      if (pattern.test($(mang[0]).val()) || pattern.test($(mang[1]).val())) {
         $('#firstname_error').text('Họ tên không được nhập số');
         flag = true;
      } else {
         $('#firstname_error').text('');
      }
      

      // Xử lý mật khẩu trùng và phải trên 6 ký tự 
      if ($(mang[3]).val() === $(mang[4]).val()) {
         var password = $(mang[3]).val();
         if (password.length < 6) {
            $('#password_error').text('Mật khẩu phải trên 6 ký tự');
            flag = true;
         } else {
            $('#password_error').text('');
            $('#confirm_password_error').text('');
         }
      } else {
         $('#password_error').text('Mật khẩu không hợp lệ');
         $('#confirm_password_error').text('Mật khẩu không hợp lệ');
         flag = true;
      }

      // Nếu hợp lệ thì xử lý
      if(flag == false) {
         var firstname = $('#firstname').val();
         var lastname = $('#lastname').val();
         var email = $('#email').val();
         var password = $('#password').val();
         $.ajax({
            url: "Controller/User.php?act=register_action",
            method: 'POST',
            data: {
               firstname,
               lastname, 
               email, 
               password
            },
            dataType: 'json', // Muốn nhận giữ liệu từ PHP phải thêm này
            success:(res) => {
               if(res.status == 422) {
                  $('#email_error').html(res.message);
               }else if(res.status == 200) {
                  Swal.fire({
                     position: "top-center",
                     icon: "success",
                     title: "Bạn đã tạo tài khoản thành công",
                     showConfirmButton: false,
                     timer: 1500
                  })

                  setTimeout(function() {
                     window.location.href = 'index.php?action=user&act=login';
                  }, 1500); // Chờ 1.5 giây trước khi chuyển hướng
               }
            },
         })
      }
   })
   
   // Sửa khách hàng
   $(document).on('click', '#update_action', function (event) {
      event.preventDefault();
      var flag = false;
      let id = $(this).val();
      let newpass = $('#newpass').val();
      if(newpass.length == 0) {
         $('#password_error').text('Mật khẩu không được để trống')
         flag = true;
      }else if(newpass.length < 6) {
         flag = true;
         $('#password_error').text('Mật khẩu không được dưới 6 kí tự')
      }

      if(flag == false) {
         $.ajax({
            url: "Controller/admin/user.php?act=update_action",
            method: 'POST',
            data: {id, newpass},
            dataType: 'json',
            success: (res) => {
               if(res.status == 200) {
                  Swal.fire({
                     position: "top-center",
                     icon: "success",
                     title: "Cập nhật khách hàng thành công",
                     showConfirmButton: false,
                     timer: 1500
                  });
                  setTimeout(function() {
                     window.location.href = "admin.php?action=user";
                  }, 1500);
               }
            }
         })
      }
   });

   // Đưa khách hàng vào thùng rác
   $(document).on('click', '#delete_user', function () { 
      let iduser = $(this).val();
      $.ajax({
         url: "Controller/Admin/user.php?act=delete_user",
         method: 'POST',
         data: {
           iduser
         },
         dataType: 'json',
         success: (res) => {
            console.log(res);
            if(res.status == 200) {
               Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Đã chuyển vào thùng rác",
                  showConfirmButton: false,
                  timer: 1500
               });
               setTimeout(function() {
                  window.location.reload();
               }, 1500);
            }
         }
      })
   })
   // Khôi phục khách hàng
   $(document).on('click', '#restore_user', function () { 
      let iduser = $(this).val();
      console.log(iduser);
      $.ajax({
         url: "Controller/Admin/user.php?act=restore_user",
         method: 'POST',
         data: {
           iduser
         },
         dataType: 'json',
         success: (res) => {
            console.log(res);
            if(res.status == 200) {
               Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Khôi phục khách hàng thành công",
                  showConfirmButton: false,
                  timer: 1500
               });
               setTimeout(function() {
                  window.location.reload();
               }, 1500);
            }
         }
      })
   })

   // Xóa khách hàng vĩnh viễn
   $(document).on('click', '#clear_user', function () { 
      let iduser = $(this).val();
      console.log(iduser);
      $.ajax({
         url: "Controller/Admin/user.php?act=clear_user",
         method: 'POST',
         data: {
           iduser
         },
         dataType: 'json',
         success: (res) => {
            console.log(res);
            if(res.status == 200) {
               Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Xoá khách hàng thành công",
                  showConfirmButton: false,
                  timer: 1500
               });
               setTimeout(function() {
                  window.location.reload();
               }, 1500);
            }
         }
      })
   })

   // Đăng nhập người dùng
   $('#formLogin_User').on('submit', function(e) {
      e.preventDefault();
      email = $('#email').val();
      password = $('#password').val();
      $.ajax({
         url: 'Controller/User.php?act=login_action',
         method: 'post',
         data: {
            email: email,
            password: password,
         },
         dataType: 'json',
         success: (res) => {
            if(res.status == 200) {
               Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Đăng nhập thành công",
                  showConfirmButton: false,
                  timer: 1500
               });
               setTimeout(() => {
                  window.location.href = 'index.php?action=home';
               }, 1500);
            }else {
               Swal.fire({
                  position: "top-center",
                  icon: "error",
                  title: "Tài khoản hoặc mật khẩu không đúng",
                  showConfirmButton: false,
                  timer: 1500
               });
            }
         }
      })
   })
})
