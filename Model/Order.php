<?php 
   class Order {
      // Lấy đơn hàng theo user_id
      function get_all_order($user_id) {
         $API = new API();
         return $API->get_All("SELECT orders.id, orders.fullname, orders.number_phone, orders.address, province.name as province, district.name as district, wards.name as wards,orders.status, orders.user_id,orders.order_id, orders.create_at, orders.delivery_time, orders.delivered_time, orders.deleted_at
         FROM orders, province, district, wards 
         WHERE orders.user_id=$user_id AND orders.province = province.province_id AND orders.district = district.district_id AND orders.wards = wards.wards_id ORDER BY orders.id DESC");
      }

      // Lấy chi tiết đơn hàng theo order_id


      // Lấy tất cả đơn hàng chờ xử lý và đang giao
      function getAll_Order() {
         $API = new API();
         return $API->get_All('SELECT orders.id, orders.fullname, orders.number_phone, orders.address, province.name as province, district.name as district, wards.name as wards,orders.status ,orders.order_id, orders.create_at, orders.delivery_time, orders.delivered_time, orders.deleted_at
         FROM orders, province, district, wards 
         WHERE orders.province = province.province_id AND orders.district = district.district_id AND orders.wards = wards.wards_id AND orders.deleted_at IS NULL AND status BETWEEN 1 AND 2 ORDER BY orders.id DESC');
      }
      // Lấy tất cả đơn hàng đã giao
      function getAll_Order1() {
         $API = new API();
         return $API->get_All('SELECT orders.id, orders.fullname, orders.number_phone, orders.address, province.name as province, district.name as district, wards.name as wards,orders.status ,orders.order_id, orders.create_at, orders.delivery_time, orders.delivered_time  
         FROM orders, province, district, wards 
         WHERE orders.province = province.province_id AND orders.district = district.district_id AND orders.wards = wards.wards_id AND status = 3 ORDER BY orders.id DESC');
      }

      // Lấy tất cả đơn hàng đã giao theo limit
      function getAll_OrderedLimit($start, $end) {
         $API = new API();
         return $API->get_All("SELECT orders.id, orders.fullname, orders.number_phone, orders.address, province.name as province, district.name as district, wards.name as wards,orders.status ,orders.order_id, orders.create_at, orders.delivery_time, orders.delivered_time  
         FROM orders, province, district, wards 
         WHERE orders.province = province.province_id AND orders.district = district.district_id AND orders.wards = wards.wards_id AND status = 3 ORDER BY orders.id DESC LIMIT $start, $end");
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
         return $API->get_one("SELECT count(status) as total_orders FROM orders WHERE status=1 AND orders.deleted_at IS NULL");
      }

      // Hủy đơn hàng bằng order_id
      function delete_Order($id) {
         $API = new API();
         return $API->add_delete_update("UPDATE orders SET deleted_at=CURRENT_TIMESTAMP WHERE order_id='$id'");
      }

      // Hủy chi tiết đơn hàng bằng order_id
      function delete_Details_Order($id) {
         $API = new API();
         return $API->add_delete_update("DELETE FROM details_order WHERE order_id='$id'");
      }

      // Lấy ra các đơn đã hủy 
      function get_cancel_order() {
         $API = new API();
         return $API->get_All("SELECT orders.id, orders.fullname, orders.number_phone, orders.address, province.name as province, district.name as district, wards.name as wards,orders.status ,orders.order_id, orders.create_at, orders.deleted_at 
         FROM orders, province, district, wards 
         WHERE orders.province = province.province_id AND orders.district = district.district_id AND orders.wards = wards.wards_id AND orders.deleted_at IS NOT NULL");
      }

      // Lấy ra các sản phẩm từ order_id
      function getDetailsProduct_ByOrderID($id) {
         $API = new API();
         return $API->get_All("SELECT ctsp.name_product, ctsp.size, ctsp.quantity FROM details_order as ctsp WHERE order_id='$id'");
      }

      // Cộng lại số lượng cho sản phẩm theo tên và size
      function increase_DetailsProduct($name_product, $size, $quantity) {
         $API = new API();
         return $API->add_delete_update("UPDATE details_product AS ctsp 
         JOIN product AS sp ON sp.id = ctsp.product_id JOIN size ON ctsp.size_id = size.id 
         SET ctsp.quantity = ctsp.quantity + $quantity WHERE size.size = '$size' AND sp.name = '$name_product'");
      }

      // Trừ lại số lượng trong bảng goods_sold theo tên và size
      function decrease_Goods_Sold($name_product, $size, $quantity) {
         $API = new API();
         return $API->add_delete_update("UPDATE goods_sold SET quantity_sold = quantity_sold-$quantity
         WHERE product_name='$name_product' AND size='$size'");
      }

      // Lấy ra lịch sử đơn hàng theo user_id
      function order_history_id($user_id) {
         $API = new API();
         return $API->get_All("SELECT ctdh.order_id, ctdh.name_product, ctdh.size, ctdh.quantity, ctdh.img, ctdh.price, dh.status, dh.delivered_time
         FROM orders as dh, details_order as ctdh 
         WHERE dh.order_id = ctdh.order_id AND user_id=$user_id AND dh.deleted_at IS NULL GROUP BY dh.delivered_time DESC");
      }

      // Lấy ra tổng tiền của các đơn hàng đã bán được (được giao)
      function sum_order_deliveried() {
         $API = new API();
         return $API->get_one("SELECT SUM(total_price) as total_money FROM details_order as ctdh, orders as dh WHERE ctdh.order_id = dh.order_id AND dh.status = 3");
      }
   }