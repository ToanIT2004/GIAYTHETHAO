<?php 
   $act = 'order';
   if(isset($_GET['act'])) {
      $act = $_GET['act'];
   }

   switch($act) {
      case 'order':
         session_start();
         include "../Model/DBConfig.php";
         include "../Model/API.php";
         include "../Model/Order.php";
         include "../Model/Goods_sold.php";
         include "../Model/Product.php";
         $connect = new connect();
         $API = new API();
         $Order = new Order();
         $Goods_sold = new Goods_sold();
         $Product = new Product();
         $fullname = $_POST['fullname'];
         $number_phone = $_POST['number_phone'];
         $address = $_POST['address'];
         $province = $_POST['province'];
         $district = $_POST['district'];
         $wards = $_POST['wards'];
         $user_id = $_POST['user_id'];
         $order_id = uniqid() . '_' . time();
         $_SESSION['order_id'] = $order_id;
         // Lưu chi tiết đơn hàng (cart)
         foreach($_SESSION['cart'] as $key=>$value) {
   
            $Order->add_DetailsOrder($value['name'],$value['size'] ,$value['quantity'], $value['img'], $value['price'], $total_value = $value['quantity'] * $value['price'], $_SESSION['order_id']);
            // trừ số lượng tồn khi thêm vào giỏ hàng
            $Product->decrease_quantity($value['name'], $value['size'], $value['quantity']);

            // Thêm vào kho
            // Kiểm tra xem trong kho đã có hàng chưa
            $result_goods_sold = $Goods_sold->check_Respository($value['name'], $value['size']);
            // echo $result_goods_sold;exit;
            // Nếu có thì cộng dồn vô
            if($result_goods_sold) {
               $quantity = $result_goods_sold['quantity_sold'] + $value['quantity'];
               $total_price = $result_goods_sold['total_Price'] + $value['quantity'] * $value['price'];
               $Goods_sold->update_Goods_Solds($result_goods_sold['id'], $quantity, $value['price'], $total_price); 
            }else {
               // Nếu không thì thêm vào 
               $Goods_sold->Add_Goods_Sold($value['name'], $value['size'], $value['quantity'], $value['price'], $total_value = $value['quantity'] * $value['price']);
            }
         }
         // Lưu thông tin đơn hàng
         $result_Order = $Order->add_Order($fullname, $number_phone, $address, $province,$district, $wards,$order_id , $user_id);
         if($result_Order) {
            $res = [
               'status' => 200,
               'message' => 'Thêm thành công',
            ];
            unset($_SESSION['cart']);
         }else {
            $res = [
               'status' => 404,
               'message' => 'Thêm không thành công',
            ];
         }
         echo json_encode($res);
   }