<?php
   $act = "login";
   if(isset($_GET['act'])) {
      $act = $_GET['act'];
   }

   switch($act) {
      case 'login':
         include_once "./View/admin/login.php";
         break;
      case 'login_action':
         $kq = "hello";
         $username = $_POST['username'];
         $password = $_POST['password'];
         include_once('../../Model/DBConfig.php');
         include_once('../../Model/API.php');
         include_once('../../Model/User.php');
         $connect = new connect();
         $API = new API();
         $user = new User();
         $user_result = $user->login_Employee($username, $password);
         if($user_result) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $res = [
               'status' => 200,
               'message' => 'Đăng nhập thành công',
            ];
         }else {
            $res = [
               'status' => 404,
               'message' => 'Đăng nhập không thành công',
            ];
         }
         echo json_encode($res);
         break;
      case 'dangxuat':
         session_unset();
         echo "<script>alert('Đăng xuất thành công')</script>";
         echo '<meta http-equiv="refresh" content="0;url=./admin.php?action=login"/>';
         break;
   }