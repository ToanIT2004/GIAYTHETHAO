$(document).ready(() => {
   // Xác nhận đơn hàng trang User
   $('#form_Order').on('click', function() {
      user_id = $('#user_id').val();
      fullname = $('#fullname').val();
      size = $('#size').val();
      number_phone = $('#number_phone').val();
      address = $('#address').val();
      province = $('#province').val();
      district = $('#district').val();
      wards = $('#wards').val();
      console.log(`${fullname} - ${number_phone} - ${address} - ${province} - ${district} - ${wards}`);
      // Xử lý tên trống 
      var mang = ['#fullname', '#number_phone', '#address', '#province', '#district', '#wards'];
      var flag = false;
      mang.forEach(arr => {
         var check = $(arr).val();
         if (check == '') {
            $(arr).addClass('border border-danger')
            flag = true;
         } else {
            $(arr).removeClass('border border-danger')   
         }
      });

      // Xử lý số điện thoại 
      if (!/^(0\d{9,10})$/.test(number_phone)) {
         $('#numberphone_error').text('Số điện thoại không hợp lệ');
         flag = true;
      }else {
         $('#numberphone_error').text('');
      }

      if(flag == false) {
         $.ajax({
            url: 'Controller/order.php?act=order',
            method: 'POST',
            data: {
               user_id: user_id,
               fullname: fullname, 
               size: size,
               number_phone: number_phone, 
               address: address, 
               province: province, 
               district: district, 
               wards: wards,
            },
            dataType: 'json',
            success: (res) => {
               if(res.status == 200) {
                  Swal.fire({
                     position: "top-center",
                     icon: "success",
                     title: "Bạn đã đặt hàng thành công",
                     showConfirmButton: false,
                     timer: 1500
                  });
                  setTimeout(() => {
                     window.location.reload();
                  }, 1500);
               }
            }
         })
      }else {
         console.log('Kh OK');
      }
   })
  
   $(document).on('change', '#select_option', function() {
      order_id = $(this).data('orderid');
      status_id = $(this).val();
      $.ajax({
         url: 'Controller/Admin/order.php?act=delivery_status',
         method: 'post',
         data: {
            order_id: order_id,
            status_id: status_id,
         },
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
   })
})