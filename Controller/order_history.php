<?php
$act = 'order_history';
if (isset($_GET['act'])) {
   $act = $_GET['act'];
}

switch ($act) {
   case 'order_history':
      include_once "view/order_history.php";
      break;
   case 'get_all_order':
      include "../Model/DBConfig.php";
      include "../Model/API.php";
      include "../Model/Order.php";
      $connect = new connect();
      $API = new API();
      $Order = new Order();
      $user_id = $_POST['user_id'];
      $result = $Order->get_all_order($user_id)->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($result);
      break;
   case 'get_order_details':
      include "../Model/DBConfig.php";
      include "../Model/API.php";
      include "../Model/Order.php";
      $connect = new connect();
      $API = new API();
      $Order = new Order();
      $order_id = $_POST['order_id'];
      $result = $Order->getAll_DetailsOrderByID($order_id)->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($result);
      break;
}