<?php
$act = 'cart';
if (isset($_GET['act'])) {
   $act = $_GET['act'];
}

switch ($act) {
   case 'cart':
      include_once "./View/cart.php";
      break;
   case 'get_district_province':
      include "../Model/DBConfig.php";
      include "../Model/API.php";
      include "../Model/Address_Order.php";
      $connect = new connect();
      $API = new API();
      $Address = new Address_Order();
      $province_id = $_POST['province_id'];
      $result = $Address->getAll_District($province_id)->fetchAll();
      echo json_encode($result);
      break;
   case 'get_wards_district':
      include "../Model/DBConfig.php";
      include "../Model/API.php";
      include "../Model/Address_Order.php";
      $connect = new connect();
      $API = new API();
      $Address = new Address_Order();
      $district_id = $_POST['district_id'];
      $ward_result = $Address->getAll_Wards($district_id)->fetchAll();
      echo json_encode($ward_result);
      break;
   case 'update_Quantity_Cart':
      session_start();
      $count = 0;
      if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
         // Đếm số lượng sản phẩm trong giỏ hàng
         foreach ($_SESSION['cart'] as $item) {
            if (isset($item['quantity'])) {
               $count += $item['quantity'];
            }
         }
      } else {
         $count = 0;
      }

      echo json_encode($count);
      break;
   case 'increase_cart':
      session_start();
      $sp_id = $_POST['sp_id'];
      if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
         foreach ($_SESSION['cart'] as &$item) {
            if ($item['idsp'] == $sp_id) {
               $item['quantity'] += 1;
               $response = array(
                  'quantity' => $item['quantity'],
               );
               echo json_encode($response);
               break;
            }
         }
         unset($item); // Hủy tham chiếu sau khi vòng lặp kết thúc
      }
      break;
   case 'decrease_cart':
      session_start();
      $sp_id = $_POST['sp_id'];
      if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
         foreach ($_SESSION['cart'] as &$item) {
            if ($item['idsp'] == $sp_id) {
               if ($item['quantity'] == 1) {
                  echo '';
               } else {
                  $item['quantity'] -= 1;
                  $response = array(
                     'quantity' => $item['quantity'],
                  );
               }
               echo json_encode($response);
               break;
            }
         }
         unset($item); // Hủy tham chiếu sau khi vòng lặp kết thúc
      }

      break;
   case 'check_quantity':
      session_start();
      // Nhận dữ liệu mảng từ AJAX
      $productPositions = json_decode($_POST['productPositions']);
      include "../Model/DBConfig.php";
      include "../Model/API.php";
      include "../Model/Product.php";
      $connect = new connect();
      $API = new API();
      $Product = new Product();

      $results = []; // Tạo một mảng kết quả
      foreach ($_SESSION['cart'] as $item) {
         $position = $item['idsp']; // Lấy vị trí của sản phẩm
         if (in_array($position, $productPositions)) { // Kiểm tra xem vị trí có trong mảng productPositions không
            $result_product = $Product->getQuantity_ByNameSize($item['name'], $item['size']);

            if ($item['quantity'] > $result_product['quantity']) {
               $res = [
                  'status' => 'false',
                  'index' => $position,
                  'message' => 'Sản phẩm không đủ hàng.',
               ];
               // Thêm mảng dữ liệu vào mảng kết quả
               $results[] = $res;
            }
         }
      }
      echo json_encode($results);
      break;
   case 'repository':
      $product_id = $_POST['product_id'];
      include "../Model/DBConfig.php";
      include "../Model/API.php";
      include "../Model/Product.php";
      $connect = new connect();
      $API = new API();
      $Product = new Product();

      $result_product = $Product->getAll_Quantity($product_id)->fetch();
      echo json_encode($result_product['count']);
      break;
   case 'repository_Size':
      $size_id = $_POST['size_id'];
      $product_id = $_POST['product_id'];
      include "../Model/DBConfig.php";
      include "../Model/API.php";
      include "../Model/Product.php";
      $connect = new connect();
      $API = new API();
      $Product = new Product();

      $result_product = $Product->getSize_Quantity($product_id, $size_id)->fetch();
      echo json_encode($result_product['count']);
      break;
   // Lấy số lượng tồn kho trong giỏ hàng 
   case 'repo_Cart':
      session_start();
      $productPositions = json_decode($_POST['productPositions']);
      include "../Model/DBConfig.php";
      include "../Model/API.php";
      include "../Model/Product.php";
      $connect = new connect();
      $API = new API();
      $Product = new Product();

      $results = []; // Tạo một mảng kết quả
      foreach ($_SESSION['cart'] as $item) {
         $position = $item['idsp']; // Lấy vị trí của sản phẩm
         if (in_array($position, $productPositions)) { // Kiểm tra xem vị trí có trong mảng productPositions không
            $result_product = $Product->getQuantity_ByNameSize($item['name'], $item['size']);
            $res = [
               'status' => 200,
               'index' => $position,
               'quantity' => $result_product['quantity']
            ];
            $results[] = $res;
         }
      }
      echo json_encode($results);
      break;
}