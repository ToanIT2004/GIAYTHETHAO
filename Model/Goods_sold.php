<?php 
   class Goods_sold {
      function Add_Goods_Sold($product_name, $size, $quantity_sold, $price, $total_Price) {
         $API = new API();
         $API->add_delete_update("INSERT INTO `goods_sold`(`product_name`, `size`, `quantity_sold`, `price`, `total_Price`) 
         VALUES ('$product_name','$size','$quantity_sold','$price','$total_Price')");
      }

      // Kiểm tra đã có hàng trong kho chưa
      function check_Respository($product_name, $size) {
         $API = new API();
         return $API->get_one("SELECT * FROM goods_sold WHERE product_name = '$product_name' AND size = $size");
      } 

      // Cập nhật lại sltồn, giá, tổng giá
      function update_Goods_Solds($id, $quantity_sold, $price, $total_Price) {
         $API = new API();
         return $API->add_delete_update("UPDATE `goods_sold` SET quantity_sold='$quantity_sold',`price`='$price',`total_Price`='$total_Price' WHERE id=$id");
      }
   }