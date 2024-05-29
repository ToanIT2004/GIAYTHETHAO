// $(document).ready(() => {
//    // Lấy id item trong giỏ hàng để xóa
//    // Mỗi sản phẩm trong giỏ hàng sẽ có 1 ID khác nhau
//    $(document).on('click', '#drop_ItemCart', function () {
//       id_item = $(this).val();
//       $.ajax({
//          url: 'Controller/details_product.php?act=delete_ItemCart',
//          method: 'post',
//          data: { id_item: id_item },
//          dataType: 'json',
//          success: (res) => {
//             window.location.reload();
//          }
//       });
//    })

//    // Thay đổi số lượng trên giỏ hàng
//    $.ajax({
//       url: 'Controller/cart.php?act=update_Quantity_Cart',
//       method: 'post',
//       dataType: 'json',
//       success: (res) => {
//          $('.position-absolute').text(res);
//       }
//    });

//    // Tăng số lượng trong giỏ hàng
//    $('.increase_cart').on('click', function () {
//       var button = $(this); // Lưu trữ thẻ button được nhấp
//       sp_id = $(this).data('id');
//       $.ajax({
//          url: 'Controller/cart.php?act=increase_cart',
//          method: 'POST',
//          data: { sp_id: sp_id },
//          dataType: 'json',
//          success: (res) => {
//             button.closest('.d-flex').find('.quantity_cart').text(res.quantity);
//             checkProductQuantities();
//          }
//       })
//    })

//    // Giảm số lượng trong giỏ hàngcheck_quantity
//    $('.decrease_cart').on('click', function () {
//       var button = $(this); // Lưu trữ thẻ button được nhấp
//       sp_id = $(this).data('id');
//       $.ajax({
//          url: 'Controller/cart.php?act=decrease_cart',
//          method: 'POST',
//          data: { sp_id: sp_id },
//          dataType: 'json',
//          success: (res) => {
//             button.closest('.d-flex').find('.quantity_cart').text(res.quantity);
//             checkProductQuantities();
//          }
//       })
//    })

//    // Chức năng kiểm tra số lượng tồn trong cart
//    // Hàm để lấy vị trí của mỗi sản phẩm trong giỏ hàng
//    function getProductPositions() {
//       var productPositions = [];
//       $('.quantity_cart').each(function () {
//          var position = $(this).data('id');
//          productPositions.push(position);
//       });
//       return productPositions; // Trả về một mảng chứa vị trí của các sản phẩm
//    }

//    cart_bigger_repo = false;
//    function checkProductQuantities() {
//       var productPositions = getProductPositions();
//       $.ajax({
//          url: 'Controller/cart.php?act=check_quantity',
//          method: 'POST',
//          data: { productPositions: JSON.stringify(productPositions) },
//          dataType: 'json',
//          success: (res) => {
//             // Đặt lại trạng thái ban đầu của các phần tử
//             $('.idsp').text('');
//             // $('.btn').attr('data-bs-toggle', 'modal');
//             // $('.btn').attr('data-bs-target', '#myModal');
//             // $('.btn').removeClass('buy_error');
//             res.forEach(item => {
//                if (item.status == 'false') {
//                   $('.idsp').each(function () {
//                      var productId = $(this).data('idsp');
//                      if (productId == item.index) {
//                         $(this).text(item.message);
//                         // $('.btn').removeAttr('data-bs-toggle data-bs-target');
//                         // $('.btn').addClass('buy_error');
//                         cart_bigger_repo = true;
//                      }
//                   });
//                }
//             });
//          },
//          error: (error) => console.log(error)
//       });
//    }

//    alert(cart_bigger_repo)
//    // Nếu giỏ hàng không đủ số lượng tồn sẽ không thể thanh toán
//    if(cart_bigger_repo == false) {
//       // Hiển thị modal cart
//       $(document).on('click', '#btn_show_modal', function () {
//          $("#modal_pay").modal("show");
//       })
//    }else {
//       alert('Không đủ hàng')
//    }


//    //Trường hợp buy error
//    $(document).on('click', '.buy_error', function () {
//       Swal.fire({
//          icon: "error",
//          title: "Vượt quá số lượng tồn kho!",
//          text: "",
//       });
//    });

//    //Lấy ra số lượng tồn theo tên session
//    // Hàm để lấy số lượng tồn theo tên session
//    function updateRepoCart() {
//       var productPositions = getProductPositions();
//       $.ajax({
//          url: 'Controller/cart.php?act=repo_Cart',
//          method: 'POST',
//          data: { productPositions: JSON.stringify(productPositions) },
//          dataType: 'json',
//          success: (res) => {
//             res.forEach(item => {
//                $('.repo_cart').each(function () {
//                   var productId = $(this).data('repo_id');
//                   if (productId === item.index) {
//                      $(this).text('Kho: ' + item.quantity);
//                   }
//                });
//             });
//          },
//          error: (error) => console.log(error)
//       });
//    }
//    checkProductQuantities();
//    updateRepoCart();
// })



$(document).ready(() => {
   // Lấy ra tổng số lượng giỏ hàng
   function get_totalCart() {
      $.ajax({
         url: 'Controller/cart.php?act=get_totalCart',
         method: 'GET',
         dataType: 'json',
         success: (res) => {
            $('#totalCart').text(res)
         }
      })
   }
   get_totalCart();

   // Lấy thành tiền từ của từng giỏ hàng
   function totalPrice_item() {
      $.ajax({
         url: 'Controller/cart.php?act=get_totalPrice_item',
         method: 'GET',
         dataType: 'json',
         success: (res) => {
            
            res.forEach(item => {
               // Cập nhật giá thành tiền của từng sản phẩm
               $(`#total_price_${item.idsp}`).text(formatCurrency(item.total_price) + 'đ');
            });
         }
      })
   }
   totalPrice_item();

   // Lấy ra tổng tiền trong giỏ hàng
   function totalPrice() {
      $.ajax({
         url: 'Controller/cart.php?act=get_totalPrice_cart',
         method: 'GET',
         dataType: 'json',
         success: (res) => {
            $('.total_price').text(formatCurrency(res) + 'đ');
         }
      })
   }
   totalPrice();

   // Xuất sl kho của từng sản phẩm
   product_id = $('#product_id').val();
   $.ajax({
      url: 'Controller/cart.php?act=repository',
      method: 'POST',
      data: { product_id: product_id },
      dataType: 'json',
      success: (res) => {
         $("#repository").text('Kho: ' + res);
      }
   })
   // Xuất sl kho của từng size khi click
   $('.btn-size').on('click', function () {
      product_id = $('#product_id').val();

      // Lấy text của nút được click
      var size_id = $(this).data('size_id');
      $.ajax({
         url: 'Controller/cart.php?act=repository_Size',
         method: 'POST',
         data: { size_id: size_id, product_id: product_id },
         dataType: 'json',
         success: (res) => {
            $("#repository").text('Kho: ' + res);
         }
      })
   });

   // Hàm để lấy vị trí của mỗi sản phẩm trong giỏ hàng
   function getProductPositions() {
      var productPositions = [];
      $('.quantity_cart').each(function () {
         var position = $(this).data('id');
         productPositions.push(position);
      });
      return productPositions; // Trả về một mảng chứa vị trí của các sản phẩm
   }

   function checkProductQuantities(callback) {
      var productPositions = getProductPositions();
      $.ajax({
         url: 'Controller/cart.php?act=check_quantity',
         method: 'POST',
         data: { productPositions: JSON.stringify(productPositions) },
         dataType: 'json',
         success: (res) => {
            // Đặt lại trạng thái ban đầu của các phần tử
            $('.idsp').text('');
            let cart_bigger_repo = false;

            res.forEach(item => {
               if (item.status == 'false') {
                  $('.idsp').each(function () {
                     var productId = $(this).data('idsp');
                     if (productId == item.index) {
                        $(this).text(item.message);
                        cart_bigger_repo = true;
                     }
                  });
               }
            });

            // Gọi callback và truyền vào trạng thái cart_bigger_repo
            callback(cart_bigger_repo);
         },
         error: (error) => console.log(error)
      });
   }

   // Hàm hiển thị modal
   function showModalIfStockIsSufficient(cart_bigger_repo) {
      if (!cart_bigger_repo) {
         $("#modal_pay").modal("show");
      } else {
         Swal.fire({
            icon: "error",
            text: "Sản phẩm trong giỏ không đủ hàng",
         });
      }
   }

   // Lấy id item trong giỏ hàng để xóa
   $(document).on('click', '#drop_ItemCart', function () {
      let id_item = $(this).val();
      $.ajax({
         url: 'Controller/details_product.php?act=delete_ItemCart',
         method: 'post',
         data: { id_item: id_item },
         dataType: 'json',
         success: (res) => {
            window.location.reload();
         }
      });
   });

   // Tăng số lượng trong giỏ hàng
   $(document).on('click', '.increase_cart', function () {
      let button = $(this); // Lưu trữ thẻ button được nhấp
      let sp_id = $(this).data('id');
      $.ajax({
         url: 'Controller/cart.php?act=increase_cart',
         method: 'POST',
         data: { sp_id: sp_id },
         dataType: 'json',
         success: (res) => {
            button.closest('.d-flex').find('.quantity_cart').text(res.quantity);
            checkProductQuantities(() => { });
            totalPrice();
            totalPrice_item();
            get_totalCart()
         }
      });
   });

   // Giảm số lượng trong giỏ hàng
   $(document).on('click', '.decrease_cart', function () {
      let button = $(this); // Lưu trữ thẻ button được nhấp
      let sp_id = $(this).data('id');
      $.ajax({
         url: 'Controller/cart.php?act=decrease_cart',
         method: 'POST',
         data: { sp_id: sp_id },
         dataType: 'json',
         success: (res) => {
            button.closest('.d-flex').find('.quantity_cart').text(res.quantity);
            checkProductQuantities(() => { });
            totalPrice();
            totalPrice_item();
            get_totalCart()
         }
      });
   });

   // Hiển thị modal khi đủ hàng
   $(document).on('click', '#btn_show_modal', function () {
      checkProductQuantities(showModalIfStockIsSufficient);
   });

   // Hàm để lấy số lượng tồn theo tên session
   function updateRepoCart() {
      var productPositions = getProductPositions();
      $.ajax({
         url: 'Controller/cart.php?act=repo_Cart',
         method: 'POST',
         data: { productPositions: JSON.stringify(productPositions) },
         dataType: 'json',
         success: (res) => {
            res.forEach(item => {
               $('.repo_cart').each(function () {
                  var productId = $(this).data('repo_id');
                  if (productId === item.index) {
                     $(this).text('Kho: ' + item.quantity);
                  }
               });
            });
         },
         error: (error) => console.log(error)
      });
   }

   checkProductQuantities(() => { });
   updateRepoCart();
});
