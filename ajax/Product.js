$(document).ready(() => {
   // Chỉnh sửa sản phẩm
   $(document).on('submit', '#form_Product', function(event) {
      event.preventDefault(); 
      let id = $('#id_product').val();
      let name = $('#name_product').val();
      let shoes_type_id = $('#shoes_type').val();
      let brand_id = $('#brand').val();
      let descriptions = $('#descriptions_product').val();
      let img = $('#prevent_img').attr('src').slice(25); // Lấy giá trị của files khi form được submit

      // Check validate trống
      checkValidate = ['#name_product', '#descriptions_product']; // Thêm ký tự "#" để tham chiếu đến id của từng trường nhập liệu
      var flag = false;
      checkValidate.forEach(field => {
         let value = $(field).val(); // Lấy giá trị của từng trường nhập liệu
         if (value.trim() == '') {
            flag = true;
            $(field + '_error').text(`Giá trị không được để trống`);
         }
      });

      if(flag == false) {
         $.ajax({
            url: 'Controller/Admin/product.php?act=update_actionPro',
            method: 'POST',
            data: {
               id,
               name, 
               shoes_type_id,
               brand_id,
               descriptions,
               img,
            },
            dataType: 'json',
            success: (res) => {
               if(res.status == 400) {
                  alert(res.message);
               }else if(res.status == 200) {
                  Swal.fire({
                     position: "top-center",
                     icon: "success",
                     title: "Dự liệu đã được thay đổi",
                     showConfirmButton: false,
                     timer: 1500
                  });
                  setTimeout(() => {
                     window.location.reload();
                  }, 1500)
               }
            }
         })
      }
   })
   // Chỉnh sửa chi tiết sản phẩm
   $(document).on('submit', '#formProduct_Details', function(event) {
      event.preventDefault();
      let id = $('#id').val();
      let price = $('#price').val();
      let discount = $('#discount').val();
      let quantity = $('#quantity').val();
      let size = $('#size').val();
      let img1 = $('#img1')[0].files[0];
      let img2 = $('#img2')[0].files[0];
      let img3 = $('#img3')[0].files[0];

      // Check validate trống và phải là số
      checkValidate = ['#price', '#discount', '#quantity']; // Thêm ký tự "#" để tham chiếu đến id của từng trường nhập liệu
      var flag = false;
      checkValidate.forEach(field => {
         let value = $(field).val(); // Lấy giá trị của từng trường nhập liệu
         if (isNaN(value)) {
            flag = true;
            $(field + '_error').text(`Giá trị phải là số`);
         } else if (value.length == 0) {
            flag = true;
            $(field + '_error').text(`Giá trị không được để trống`);
         }
      });

      // tối ưu chỗ này bằng vòng lặp 
      let hinh1; // Khai báo biến hinh1 trước khi sử dụng
      if (img1 == undefined) {
         hinh1 = $('#preview_img1').val();
      } else {
         hinh1 = img1.name;
      }

      let hinh2; // Khai báo biến hinh2 trước khi sử dụng
      if (img2 == undefined) {
         hinh2 = $('#preview_img2').val();
      } else {
         hinh2 = img2.name;
      }

      let hinh3; // Khai báo biến hinh3 trước khi sử dụng
      if (img3 == undefined) {
         hinh3 = $('#preview_img3').val();
      } else {
         hinh3 = img3.name;
      }
      
      if(flag == false) {
         $.ajax({
            url: 'Controller/Admin/product.php?act=update_action',
            method: 'POST',
            data: {
               id,
               price,
               discount,
               quantity,
               size, 
               hinh1,
               hinh2,
               hinh3
            },
            success: (res) => {
               let data = JSON.parse(res);
               console.log(data.status);
               if(data.status == 200) {
                  Swal.fire({
                     position: "top-center",
                     icon: "success",
                     title: "Chỉnh sửa thành công",
                     showConfirmButton: false,
                     timer: 1500
                  });

                  setTimeout(() => {
                     window.location.reload();
                  }, 1500);
               }else if(data.status == 404) {
                  Swal.fire({
                     icon: "error",
                     title: "Lỗi...",
                     text: "Tệp không phải là ảnh!",
                  });
                  $('#img_error').text(data.message);
               }
            }
         })
      }
   });
});
