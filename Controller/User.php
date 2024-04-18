<?php 
   //  include "../Model/DBConfig.php";
   //  include "../Model/User.php";
   //  include "../Model/API.php";
   $act = 'login';
   if(isset($_GET['act'])) {
      $act = $_GET['act'];
   }

   switch($act) { 
      case 'login': 
         include_once "./View/User.php";
         break;
      case 'register':
         include_once "./View/User.php";
         break;
      // Thực hiện việc đăng nhập
      case 'login_action':
         $user = new User();
         $kq = $user->login_User('admin', '123123');
         // print_r($kq);exit;
         // Chuyển code về json
         echo json_encode($kq);
         // if(isset($_POST['login_submit'])) {
         //    $email = $_POST['email'];
         //    $password = $_POST['password'];
         //    $user = new User();
         //    $kq = $user->login_User($email, $password);
         //    if(!$kq) {
         //       echo "<script>
         //          Swal.fire({
         //             icon: 'error',
         //             title: 'Oops...',
         //             text: 'Something went wrong!',
         //          });
         //       </script>";
         //    }

         // echo '<script>console.log("dk")</script>';
         // } 
         break;
      // Thực hiệc việc đăng ký
      case 'register_action':
         include "../Model/DBConfig.php";
         include "../Model/User.php";
         include "../Model/API.php";
         // if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET['act']) && $_GET['act'] === 'register_action') {
            // Lấy giá trị của firstname, lastname, email và password từ $_POST
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $connect = new connect();
            $API = new API();
            $user = new User();
            $kq = $user->getOne_UserByEmail($email);
            if($kq) {
               $res = [
                  'status' => 422, 
                  'message' => 'Tài khoản đã tồn tại',
               ];
               echo json_encode($res); // Gửi chuyển dữ liệu JSON
            }else {
               $user->add_User($lastname, $firstname, $email, $password);
               $res = [
                  'status' => 200,
                  'message' => 'Bạn đã tạo tài khoản thành công'
               ];
               echo json_encode($res); // Gửi chuyển dữ liệu JSON
            }
           
      //   }
      break;
}