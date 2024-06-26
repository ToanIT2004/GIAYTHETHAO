<?php
$act = 'info_user';
if (isset($_GET['act'])) {
   $act = $_GET['act'];
}

switch ($act) {
   case 'info_user':
      include_once "./View/info_user.php";
      break;
   // Lấy dữ liệu thông tin khách hàng
   case 'get_info_user':
      include "../Model/DBConfig.php";
      include "../Model/User.php";
      include "../Model/API.php";
      $connect = new connect();
      $API = new API();
      $user = new User();
      $user_id = $_POST['user_id'];
      $result_user = $user->getUserInfoPDW_ByID($user_id)->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($result_user);
      break;
   // Cập nhật thông tin khách hàng
   case 'add_user_address':
      include "../Model/DBConfig.php";
      include "../Model/User.php";
      include "../Model/API.php";
      $connect = new connect();
      $API = new API();
      $user = new User();
      $user_id = $_POST['user_id'];
      $fullname = $_POST['fullname'];
      $numberphone = $_POST['numberphone'];
      $address = $_POST['address'];
      $wards = $_POST['wards'];
      $district = $_POST['district'];
      $province = $_POST['province'];

      $flag = false;
      $check_user = $user->getUserInfo_ID($user_id)->fetchAll();
      foreach($check_user as $arr) {
         if($arr['wards'] == $wards && $arr['district'] == $district && $arr['province'] == $province) {
            $flag = true;
         }
      }

      if ($flag == true) {
         $res = [
            'status' => 404,
            'message' => 'Địa chỉ này đã tồn tại',
         ];
      } else {
         $user->chose_address_isZero($user_id);

         $result = $user->add_user_address($user_id, $fullname, $numberphone, $address, $wards, $district, $province);
         if ($result) {
            $res = [
               'status' => 200,
               'message' => 'Thêm thông tin thành công',
            ];
         } else {
            $res = [
               'status' => 403,
               'message' => 'Lỗi hệ thống',
            ];
         }
      }
      echo json_encode($res);
      break;
   case 'delete_user_address':
      include "../Model/DBConfig.php";
      include "../Model/User.php";
      include "../Model/API.php";
      $connect = new connect();
      $API = new API();
      $user = new User();
      $user_address_id = $_POST['user_address_id'];

      // $user_address = $user->get_user_adress_id($user_address_id);
      // if($user_address['role'] == 1) {
      //    // Bỏ session
        
      //    $result = $user->delete_user_address($user_address_id);
      // }else {
      //    $result = $user->delete_user_address($user_address_id);
      // }

      $result = $user->delete_user_address($user_address_id);

      if($result) {
         $res = [
            'status' => 200,
         ];
      }
      echo json_encode($res);
      break;
   case 'save_avatar':
      $user_id = $_POST['user_id'];
      $avatar = $_FILES['avatar']['name'];
      include "../Model/DBConfig.php";
      include "../Model/User.php";
      include "../Model/API.php";
      $connect = new connect();
      $API = new API();
      $user = new User();
      // Kiểm tra user đã có avatar chưa
      $get_avatar_user = $user->get_avatar_id($user_id);
      if($get_avatar_user) {
         $result_save = $user->update_avatar($user_id,$avatar); 
         if($result_save) {
            $res = [
               'status' => '200',
               'message' => 'Cập nhật hình ảnh thành công',
            ];
         }else {
            $res = [
               'status' => '404',
               'message' => 'Tệp hình ảnh giống nhau',
            ];
         }
      }else {
         $result_save = $user->save_avatar($user_id,$avatar); 
         if($result_save) {
            $res = [
               'status' => '200',
               'message' => 'Cập nhật hình ảnh thành công',
            ];
         }
      }
      echo json_encode($res);
      break;
   // Chọn địa chỉ giao hàng cho user
   case 'chose_address': 
      include "../Model/DBConfig.php";
      include "../Model/User.php";
      include "../Model/API.php";
      $connect = new connect();
      $API = new API();
      $user = new User();
      $user_address_id = $_POST['user_address_id'];
      $user_id = $_POST['user_id'];
      // Chuyển tất cả về 0 trước
      $user->chose_address_isZero($user_id);

      // Sau đó cập nhật
      $result = $user->chose_address($user_address_id);
      if($result) {
         $res = [
            'status' => 200,
         ];
      }else {
         $res = [
            'status' => 403,
         ];
      }
      echo json_encode($res);
      break;
   // Cập nhật thêm thông tin user
   case 'update_info_user':
      include "../Model/DBConfig.php";
      include "../Model/User.php";
      include "../Model/API.php";
      $connect = new connect();
      $API = new API();
      $user = new User();
      $user_id = $_POST['user_id'];
      $lastname = $_POST['lastname'];
      $firstname = $_POST['firstname'];
      $gender = $_POST['gender'];
      $day = $_POST['day'];
      $month = $_POST['month'];
      $year = $_POST['year'];
      $number_phone = $_POST['number_phone'];

      $result_update = $user->update_info_user($user_id, $lastname, $firstname, $gender, $day, $month, $year, $number_phone);
      if($result_update) {
         $res = [
            'status' => 200,
            'message' => 'Cập nhật thông tin thành công',
         ];
      }else {
         $res = [
            'status' => 403,
            'message' => 'Hãy thay đổi thông tin',
         ];
      }
      echo json_encode($res);
      break;
}