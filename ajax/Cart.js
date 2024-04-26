$(document).ready(() => {
   // Lấy id item trong giỏ hàng để xóa
   // Mỗi sản phẩm trong giỏ hàng sẽ có 1 ID khác nhau
   $(document).on('click', '#drop_ItemCart', function() {
      id_item = $(this).val();
      $.ajax({
         url:'Controller/details_product.php?act=delete_ItemCart',
         method: 'post',
         data: {id_item: id_item},
         dataType: 'json',
         success: (res) => {
            window.location.reload();
         }
      });
   })

   // Thay đổi số lượng trên giỏ hàng
   $.ajax({
      url:'Controller/cart.php?act=update_Quantity_Cart',
      method: 'post',
      dataType: 'json',
      success: (res) => {
          $('.position-absolute').text(res);
      }
   });

   // Tăng số lượng trong giỏ hàng
   $('.increase_cart').on('click', function() {
      var button = $(this); // Lưu trữ thẻ button được nhấp
      sp_id = $(this).data('id');
      $.ajax({
         url: 'Controller/cart.php?act=increase_cart',
         method: 'POST',
         data: {sp_id: sp_id},
         dataType: 'json',
         success: (res) => {
            button.closest('.d-flex').find('.quantity_cart').text(res.quantity);
            window.location.reload();
         }
      })
   })

    // Giảm số lượng trong giỏ hàng
    $('.decrease_cart').on('click', function() {
      var button = $(this); // Lưu trữ thẻ button được nhấp
      sp_id = $(this).data('id');
      $.ajax({
         url: 'Controller/cart.php?act=decrease_cart',
         method: 'POST',
         data: {sp_id: sp_id},
         dataType: 'json',
         success: (res) => {
            button.closest('.d-flex').find('.quantity_cart').text(res.quantity);
            window.location.reload();
         }
      })
   })

   // Xuất sl kho của từng sản phẩm
   product_id = $('#product_id').val();
   $.ajax({
      url: 'Controller/cart.php?act=repository',
      method: 'POST',
      data: {product_id: product_id},
      dataType: 'json',
      success: (res) => {
         $("#repository").text('Kho: '+ res);
      }
   }) 
   // Xuất sl kho của từng size khi click
   $('.btn-size').on('click', function() {
      product_id = $('#product_id').val();

      // Lấy text của nút được click
      var size_id = $(this).data('size_id');
      $.ajax({
         url: 'Controller/cart.php?act=repository_Size',
         method: 'POST',
         data: {size_id: size_id, product_id: product_id},
         dataType: 'json',
         success: (res) => {
            $("#repository").text('Kho: '+ res);
         }
      }) 
   });



   // Chức năng kiểm tra số lượng tồn trong cart
   // Hàm để lấy vị trí của mỗi sản phẩm trong giỏ hàng
   function getProductPositions() {
      var productPositions = [];
      $('.quantity_cart').each(function() {
         var position = $(this).data('id');
         productPositions.push(position);
      });
      return productPositions; // Trả về một đối tượng chứa cả vị trí và số lượng
   }

  var productPositions = getProductPositions();
  $.ajax({
      url: 'Controller/cart.php?act=check_quantity',
      method: 'POST',
      data: {productPositions: JSON.stringify(productPositions)},
      dataType: 'json',
      success: (res) => {
         res.forEach(item => {
            $('.idsp').each(function() {
               var productId = $(this).data('idsp');
               if (productId == item.index) {
                  $(this).text(item.message);   
                  $('.btn').removeAttr('data-bs-toggle data-bs-target');
                  $('.btn').addClass('buy_error');
               }
            });
         });
      }
  });

   // Trường hợp buy error
   $(document).on('click', '.buy_error', function() {
      Swal.fire({
         icon: "error",
         title: "Vượt quá số lượng tồn kho!",
         text: "",
      });
   });

   //Lấy ra số lượng tồn theo tên session
   $.ajax({
      url: 'Controller/cart.php?act=repo_Cart',
      method: 'POST',
      data: {productPositions: JSON.stringify(productPositions)},
      dataType: 'json',
      success: (res) => {
         res.forEach(item => {
            $('.repo_cart').each(function() {
               var productId = $(this).data('repo_id');
               if(productId === item.index) {
                  $(this).text('Kho: '+item.quantity)
               }
            })
         })
      }
  });
})