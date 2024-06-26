<?php 
   class User {
      // Lấy khách hàng chưa vào thùng rác
      function getAll_User() {
         $API = new API();
         return $API->get_All("SELECT * FROM user WHERE user.delete_at IS NULL");
      }

      // Lấy khách hàng vào thùng rác
      function getAllClear_User() {
         $API = new API();
         return $API->get_All("SELECT * FROM `user` WHERE user.delete_at IS NOT NULL");
      }

      // Lấy khách hàng LIMIT
      function getAll_UserLimit($start, $end) {
         $API = new API();
         return $API->get_All("SELECT * FROM `user` WHERE user.delete_at IS NULL LIMIT $start, $end");
      }

      function getOne_User($id) {
         $API = new API();
         return $API->get_one("SELECT * FROM user WHERE id=$id");
      }

      // Login 
      function login_Employee($user, $password) {
         $API = new API();
         return $API->get_one("SELECT * FROM admin WHERE username='$user' AND password='$password'");
      } 

      // Lấy User theo email
      function getOne_UserByEmail($email) {
         $API = new API();
         return $API->get_one("SELECT user.email FROM user WHERE email='$email'");
      }

      function login_User($email, $password) {
         $API = new API();
         return $API->get_one("SELECT id, lastname,firstname ,email, password FROM user WHERE email='$email' AND password='$password' AND delete_at is null");
      }

      function add_User($lastname, $firstname, $email, $password) {
         $API = new API();
         return $API->add_delete_update("INSERT INTO `user`(`lastname`, `firstname`, `email`, `password`) VALUES ('$lastname','$firstname','$email','$password')");
      }

      function updatePass_User($newpass, $id) {
         $API = new API();
         return $API->add_delete_update("UPDATE `user` SET `password`='$newpass' WHERE id=$id");
      }

      // Chỉ đưa vào thùng rác không xóa 
      function delete_User($id) {
         $API = new API();
         return $API ->add_delete_update("UPDATE user SET delete_at = CURRENT_TIMESTAMP WHERE id=$id");
      }

      // Khôi phục
      function Restore_User($id) {
         $API = new API();
         return $API ->add_delete_update("UPDATE user SET delete_at = NULL WHERE id=$id");
      }

      // Xóa Vĩnh Viễn
      function clear_User($id) {
         $API = new API();
         return $API ->add_delete_update("DELETE FROM user WHERE id=$id");
      }

      // Kiểm tra mail tồn 
      function check_Mail($email) {
         $API = new API();
         return $API->get_All("SELECT email FROM user WHERE email='$email' AND delete_at IS NULL");
      }

      // Update password User
      function update_Password($email, $newpass) {
         $API = new API();
         return $API->add_delete_update("UPDATE user SET password='$newpass' WHERE email='$email'");
      }

      // Lấy ra thông tin của khách hàng bằng ID
      function getUserInfo_ID($id) {
         $API = new API();
         return $API->get_All("SELECT * FROM user_address WHERE user_id=$id");
      }

      // Thêm thông tin khách hàng
      function add_user_address($user_id, $fullname, $number_phone, $address, $wards, $district, $province) {
         $API = new API();
         return $API->add_delete_update("INSERT INTO user_address(user_id, fullname, number_phone, address, wards, district, province, role) 
         VALUES ('$user_id', '$fullname', '$number_phone', '$address', '$wards', '$district', '$province', 1)");
      }

      // Cập nhật thông tin khách hàng
      function updateUserInfo_ID($user_id, $fullname, $number_phone, $address, $wards, $district, $province) {
         $API = new API();
         return $API->add_delete_update("UPDATE user_address 
         SET fullname='$fullname',number_phone='$number_phone',address='$address',wards='$wards',district='$district',province='$province' 
         WHERE user_id=$user_id");
      }

      // Lấy thông tin khách hàng với bảng province, district, wards bằng ID
      function delete_user_address($id) {
         $API = new API();
         return $API->add_delete_update("DELETE FROM user_address WHERE user_address.id=$id");
      }

      function getUserInfoPDW_ByID($user_id) {
         $API = new API();
         return $API->get_All("SELECT user_address.id, user_address.user_id, user_address.fullname, user_address.number_phone, user_address.address, province.name as province, district.name as district, wards.name as wards , province.province_id as province_id, district.district_id as district_id, wards.wards_id as wards_id, user_address.role
         FROM user_address, province, district, wards 
         WHERE user_address.wards = wards.wards_id AND user_address.district = district.district_id AND user_address.province = province.province_id AND user_address.user_id = $user_id GROUP BY id DESC");
      }

      // Lấy bảng user_address bằng id
      function get_user_adress_id($id) {
         $API = new API();
         return $API->get_one("SELECT * FROM user_address WHERE id=$id");
      }

      // Chọn địa chỉ giao hàng cho user
      function chose_address($id) {
         $API = new API();
         return $API->add_delete_update("UPDATE user_address SET role=1 WHERE id=$id");
      }

      // Chuyển tất cả role về 0 cho theo user_id
      function chose_address_isZero($user_id) {
         $API = new API();
         return $API->add_delete_update("UPDATE user_address SET role=0 WHERE user_id=$user_id");
      }

      // Thêm hình ảnh 
      function save_avatar($user_id, $avatar) {
         $API = new API();
         return $API->add_delete_update("INSERT INTO `user_avatar`(`user_id`, `avatar`) 
         VALUES ('$user_id','$avatar')");
      }

      // Cập nhật avatar
      function update_avatar($user_id, $avatar) {
         $API = new API();
         return $API->add_delete_update("UPDATE user_avatar 
         SET avatar='$avatar' WHERE user_id = '$user_id'");
      }

      // Lấy hình ảnh theo ID 
      function get_avatar_id($user_id) {
         $API = new API();
         return $API->get_one("SELECT * FROM user_avatar WHERE user_id='$user_id'");
      }

      // Cập nhật thông tin cho user
      function update_info_user($user_id, $lastname, $firstname, $gender, $day, $month, $year, $number_phone) {
         $API = new API();
         return $API->add_delete_update("UPDATE user 
         SET lastname='$lastname',firstname='$firstname',gender='$gender',`birthday`='$year-$month-$day',number_phone='$number_phone' WHERE id=$user_id");
      }

      // Lấy ra mật khẩu của user
      function get_password_user($user_id) {
         $API = new API();
         return $API->get_one("SELECT password FROM user WHERE id=$user_id");
      }

      // Lấy ra mật khẩu của admin
      function get_password_admin($admin_id) {
         $API = new API();
         return $API->get_one("SELECT password FROM admin WHERE admin_id=$admin_id");
      }

      // Thực hiện việc thay đổi mật khẩu user
      function update_password_user($user_id, $password_new) {
         $API = new API();
         return $API->add_delete_update("UPDATE user SET password='$password_new' WHERE id='$user_id'");
      }

      // Thực hiện việc thay đổi mật khẩu admin
      function update_password_admin($admin_id, $password_new) {
         $API = new API();
         return $API->add_delete_update("UPDATE admin SET password='$password_new' WHERE admin_id='$admin_id'");
      }
   }