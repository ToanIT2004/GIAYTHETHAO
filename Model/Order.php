<?php 
   class Order {
      // Lấy tất cả đơn hàng chờ xử lý và đang giao
      function getAll_Order() {
         $API = new API();
         return $API->get_All('SELECT orders.id, orders.fullname, orders.number_phone, orders.address, province.name as province, district.name as district, wards.name as wards,orders.status ,orders.order_id, orders.create_at, orders.delivery_time, orders.delivered_time  
         FROM orders, province, district, wards 
         WHERE orders.province = province.province_id AND orders.district = district.district_id AND orders.wards = wards.wards_id AND status BETWEEN 1 AND 2');
      }
      // Lấy tất cả đơn hàng đã giao
      function getAll_Order1() {
         $API = new API();
         return $API->get_All('SELECT orders.id, orders.fullname, orders.number_phone, orders.address, province.name as province, district.name as district, wards.name as wards,orders.status ,orders.order_id, orders.create_at, orders.delivery_time, orders.delivered_time  
         FROM orders, province, district, wards 
         WHERE orders.province = province.province_id AND orders.district = district.district_id AND orders.wards = wards.wards_id AND status = 3');
      }
      function add_Order($fullname, $numberphone, $address, $province, $district, $wards,$order_id ,$user_id) {
         $API = new API();
         return $API->add_delete_update("INSERT INTO orders(fullname, number_phone, address, province, district, wards, order_id, user_id, create_at) 
         VALUES ('$fullname', '$numberphone', '$address', '$province', '$district', '$wards', '$order_id', '$user_id', CURRENT_TIMESTAMP)");
      }

      function add_DetailsOrder($name_product,$size ,$quantity, $img, $price, $total_price, $order_id) {
         $API = new API();
         return $API->add_delete_update("INSERT INTO details_order(name_product,size, quantity, img, price,total_price ,order_id) VALUES ('$name_product','$size','$quantity','$img','$price','$total_price', '$order_id')");
      }

      function getAll_DetailsOrderByID($order_id) {
         $API = new API();
         return $API->get_All("SELECT * FROM details_order WHERE order_id='$order_id'");
      }

      // Lấy ra tổng đơn hàng chờ xử lý 
      function getAll_WaitOrder() {
         $API = new API();
         return $API->get_All("SELECT count(status) as total_orders FROM orders WHERE status=1");
      }

      // Hủy đơn hàng bằng order_id
      function delete_Order($id) {
         $API = new API();
         return $API->add_delete_update("DELETE FROM orders WHERE order_id='$id'");
      }

      // Hủy chi tiết đơn hàng bằng order_id
      function delete_Details_Order($id) {
         $API = new API();
         return $API->add_delete_update("DELETE FROM DETAILS_ORDER WHERE order_id='$id'");
      }

      // Lấy ra các sản phẩm từ order_id
      function getDetailsProduct_ByOrderID($id) {
         $API = new API();
         return $API->get_All("SELECT ctsp.name_product, ctsp.size, ctsp.quantity FROM DETAILS_ORDER as ctsp WHERE order_id='$id'");
      }

      // Cộng lại số lượng cho sản phẩm theo tên và size
      function increase_DetailsProduct($name_product, $size, $quantity) {
         $API = new API();
         return $API->add_delete_update("UPDATE details_product AS ctsp 
         JOIN product AS sp ON sp.id = ctsp.product_id JOIN size ON ctsp.size_id = size.id 
         SET ctsp.quantity = ctsp.quantity + $quantity WHERE size.size = '$size' AND sp.name = '$name_product'");
      }
   }