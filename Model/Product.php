<?php 
   class Product {
      // Phần sản phẩm

      // Lấy tất cả sản phẩm 
      function getAll_Product() {
         $API = new API();
         return $API->get_All("SELECT * FROM product");
      }

      // Lấy sản phẩm bằng ID 
      function getByID_Product($id) {
         $API = new API();
         return $API->get_one("SELECT * FROM product WHERE id=$id");
      }
      function add_Product($name_product,$shoes_type_id ,$brand_id, $description, $img) {
         $API = new API();
         $API->add_delete_update(
            "INSERT INTO `product`(`name`, `shoes_type_id`, `brand_id`, `descriptions`, `img`) VALUES ('$name_product','$shoes_type_id','$brand_id','$description','$img')"
         );
      }

      // Kiểm tra sản phẩm trùng
      function get_ProductBy($name, $shoes_type_id, $brand_id) {
         $API = new API();
         return $API->get_one("SELECT pro.name, pro.shoes_type_id, pro.brand_id FROM product as pro 
         WHERE pro.name='$name' AND pro.shoes_type_id=$shoes_type_id AND pro.brand_id=$brand_id");
      }

      // Get product by name, brand's name, shoes's name
      function get_ProductByNBS() {
         $API = new API();
         return $API->get_All("SELECT product.name , product.id AS id,brand.name_brand AS brand_name, shoes_type.name AS shoes_type_name 
         FROM product JOIN brand ON product.brand_id = brand.id 
         JOIN shoes_type ON product.shoes_type_id = shoes_type.id");
      }

      // Chỉnh sửa sản phẩm bằng ID
      function update_Product($id, $name, $shoes_type_id, $brand_id, $descriptions, $img) {
         $API = new API();
         return $API->add_delete_update("UPDATE `product` 
         SET `name` = '$name', `shoes_type_id` = $shoes_type_id, `brand_id` = $brand_id, `descriptions` = '$descriptions', `img` = '$img'
         WHERE `id` = $id;");
      }

      function delete_Product($id) {
         $API = new API();
         $API->add_delete_update("DELETE FROM `product` WHERE id='$id'");
      }

      // Phần chi tiết sản phẩm
      // lấy chi tiết sản phẩm theo id
      function get_ProductDetailsByID($id) {
         $API = new API();
         return $API->get_All("SELECT ctsp.id, ctsp.product_id, s.size,ctsp.price, ctsp.discount, ctsp.quantity, ctsp.img1, ctsp.img2, ctsp.img3 FROM details_product as ctsp,size as s WHERE ctsp.size_id = s.id AND ctsp.product_id='$id'");
      }

      // Get product name, brand's name, shoes's name by ID
      function get_ProductByID($id) {
         $API = new API();
         return $API->get_one("SELECT product.name , product.id AS id,brand.name_brand AS brand_name, shoes_type.name AS shoes_type_name 
         FROM product JOIN brand ON product.brand_id = brand.id JOIN shoes_type ON product.shoes_type_id = shoes_type.id 
         WHERE product.id=$id");
      }
      function add_ProductDetails($product_id, $size_id, $price, $discount, $quantity, $img1, $img2, $img3) {
         $API = new API();
         $API->add_delete_update(
            "INSERT INTO `details_product`(`product_id`, `size_id`, `price`, `discount`, `quantity`, `img1`, `img2`, `img3`) VALUES ($product_id,$size_id,$price,$discount,$quantity, '$img1', '$img2', '$img3')"
         );
      }

      // Lấy chi tiết sản phẩm với tên size bằng ID
      function get_ProductDetailsBySize($id) {
         $API = new API();
         return $API->get_one("SELECT ctsp.id, ctsp.product_id, ctsp.price, ctsp.discount, ctsp.quantity, ctsp.img1, ctsp.img2, ctsp.img3, s.size FROM details_product as ctsp, size as s WHERE ctsp.size_id = s.id AND ctsp.id=$id");
      }

      function delete_ProductDetails($id) {
         $API = new API();
         $API->add_delete_update("DELETE FROM details_product WHERE id=$id");
      }

      // Chỉnh sửa chi tiết sản phẩm 
      function update_ProductDetails($price, $discount, $quantity, $img1, $img2, $img3, $id) {
         $API = new API();
         return $API->add_delete_update("UPDATE details_product SET `price`='$price',`discount`='$discount',`quantity`='$quantity',`img1`='$img1',`img2`='$img2',`img3`='$img3' WHERE id=$id");
      }
   }
   