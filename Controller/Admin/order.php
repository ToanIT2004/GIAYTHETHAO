<?php 
   $act = 'order';
   if(isset($_GET['act'])) {
      $act = $_GET['act'];
   }

   switch($act) {
      case 'order':
         include_once './View/Admin/Order.php';
         break;
      case 'deliveried':
         include_once './View/Admin/Order.php';
      case 'details':
         include_once './View/Admin/Order_Details.php';
         break;
      // Chuyển trạng thái đang giao
      case 'delivery_status':
         include_once('../../Model/DBConfig.php');
         include_once('../../Model/API.php');
         include_once('../../Model/Status.php');
         include_once('../../Model/Order.php');
         $connect = new connect();
         $API = new API();
         $status = new Status();
         $Order = new Order();
         $order_id = $_POST['order_id'];
         $status_id = $_POST['status_id'];
         if($status_id == 2) {
            $result_status = $status->delivery_status($status_id, $order_id);
         }else if($status_id == 3) {
            $result_status = $status->deliveried_status($status_id, $order_id);
         }else if($status_id == 4) {
            // Chức năng cộng lại số lượng tồn khi hủy đơn bằng order_id
            $array = array();
            // Từ order ID lấy ra tên, size, quantity
            $product = $Order->getDetailsProduct_ByOrderID($order_id);
            while($product_set = $product->fetchAll(PDO::FETCH_ASSOC)) {
               $array = $product_set;
            }
            // Từ tên và size cộng lại số lượng  bảng details_product
            foreach($array as $arr) {
               $Order->increase_DetailsProduct($arr['name_product'], $arr['size'], $arr['quantity']);
            }

            // Từ tên và size trừ đi số lượng bảng goods_sold
            foreach($array as $arr) {
               $Order->decrease_Goods_Sold($arr['name_product'], $arr['size'], $arr['quantity']);
            }

            $Order->delete_Details_Order($order_id);
            $result_status = $Order->delete_Order($order_id);
         };

         if($result_status) {
            $res = [
               'status' => 200, 
               'message' => 'Đã chuyển trạng thái thành công',
            ];
         }
         echo json_encode($res);
         break;
   }