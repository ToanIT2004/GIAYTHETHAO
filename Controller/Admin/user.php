<?php 
   // set_include_path(get_include_path().PATH_SEPARATOR.'../../Model/');
   // spl_autoload_extensions('.php');
   // spl_autoload_register();
   $act = 'user';
   if(isset($_GET['act'])) {
      $act = $_GET['act'];
   }

   switch($act) {
      case 'user': 
         include_once "./View/Admin/User.php";
         break;
      case 'khoiphuc':
         include_once "./View/Admin/User.php";
         break;
      // Lấy tất cả User chưa đưa vào restore
      case 'getAll_User':
         include_once('../../Model/DBConfig.php');
         include_once('../../Model/API.php');
         include_once('../../Model/User.php');
         $connect = new connect();
         $API = new API();
         $user = new User();
         $users = $user->getAll_User()->fetchAll();
         echo json_encode($users);
         break;
      case 'update_user':
         include_once "./View/Admin/Edit_User.php";
         break;
      case 'update_action': 
         $id = $_POST['id'];
         $newpass = $_POST['newpass'];
         include_once('../../Model/DBConfig.php');
         include_once('../../Model/API.php');
         include_once('../../Model/User.php');
         $connect = new connect();
         $API = new API();
         $user = new User();
         $kq = $user->updatePass_User($newpass, $id);
         if($kq) {
            $res = [
               'status' => 200,
               'message' => 'Update thành công', 
            ];
            echo json_encode($res);
         }
         break;
      case 'delete_user':
         $iduser = $_POST['iduser'];
         include_once('../../Model/DBConfig.php');
         include_once('../../Model/API.php');
         include_once('../../Model/User.php');
         $connect = new connect();
         $API = new API();
         $user = new User();
         $kq = $user->delete_User($iduser);
         if($kq) {
            $res = [
               'status' => 200, 
               'message' => 'Xóa tài khoản thành công'
            ];
            echo json_encode($res);
         }
         break;
      case 'clear_user': 
         $iduser = $_POST['iduser'];
         include_once('../../Model/DBConfig.php');
         include_once('../../Model/API.php');
         include_once('../../Model/User.php');
         $connect = new connect();
         $API = new API();
         $user = new User();
         $kq = $user->clear_User($iduser);
         if($kq) {
            $res = [
               'status' => 200, 
               'message' => 'Xóa tài khoản thành công'
            ];
            echo json_encode($res);
         }
         break;
      case 'restore_user':
         $iduser = $_POST['iduser'];
         include_once('../../Model/DBConfig.php');
         include_once('../../Model/API.php');
         include_once('../../Model/User.php');
         $connect = new connect();
         $API = new API();
         $user = new User();
         $kq = $user->Restore_User($iduser);
         if($kq) {
            $res = [
               'status' => 200, 
               'message' => 'Khôi phục tài khoản thành công'
            ];
            echo json_encode($res);
         }
         break;
   }