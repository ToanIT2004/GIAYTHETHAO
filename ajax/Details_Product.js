$(document).ready(function (){
   // Xử lí thay đổi hình ảnh 
   // Lắng nghe sự kiện click trên các hình ảnh
   $('.thumbnail').click(function() {
      // Lấy đường dẫn của hình ảnh được click
      var imgSrc = $(this).attr('data-src');
      // Cập nhật đường dẫn hình ảnh trong card
      $('#product-detail').attr('src', './View/assets/img/upload/' + imgSrc);
  });

   // Lấy sản phẩm bỏ vào giỏ hàng
   // Cắm cờ để xác định người ta đã chọn size chưa 
   flag = false;
   $('.btn-size').click(function() {
      // Xóa lớp "active" khỏi tất cả các nút kích thước
      $('.btn-size').removeClass('active');
      // Thêm lớp "active" vào nút kích thước được click
      $(this).addClass('active');
      flag = true;
   })

   $('#addCart').click(function() {
      if (!flag) {
         alert("Vui lòng chọn kích thước trước khi thêm vào giỏ hàng.");
         return; // Dừng lại nếu kích thước chưa được chọn
      }
      var id_product = $('#idsp').val();
      var name_product = $('#name_product').text();
      var img = $('#product-detail').attr('data-src');
      var shoes_type = $('#shoes_type').text();
      var brand = $('#brand').text();
      var quantity = $('#product-quanity').val();
      var price = $('#discount').data('value') == 0 ? $('#price').data('value') : $('#discount').data('value');
      var size = $('.btn-size.active').text();
      // console.log(`${img} - ${shoes_type} - ${brand} - ${price} - ${size} - ${quantity} - ${id_product}`);return;
      $.ajax({
         url: 'Controller/details_product.php?act=addCart',
         method: 'post',
         data: {id_product, name_product, img, shoes_type, brand, quantity, price, size},
         dataType: 'json', // Muốn nhận giữ liệu từ PHP phải thêm này
         success: (res) => {
            if(res.status == 200) {
               Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Bạn đã thêm sản phẩm vào giỏ hàng",
                  showConfirmButton: false,
                  time: 1500
               });
   
               setTimeout(() => {
                  window.location.reload();
               }, 1500);
            }else if(res.status == 201) {
               Swal.fire(res.message);
            }
            
         }
      }) 
   })
});