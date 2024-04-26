<?php 
   class User {
      // Lấy khách hàng chưa vào thùng rác
      function getAll_User() {
         $API = new API();
         return $API->get_All("SELECT * FROM `user` WHERE user.delete_at IS NULL");
      }

      // Lấy khách hàng vào thùng rác
      function getAllClear_User() {
         $API = new API();
         return $API->get_All("SELECT * FROM `user` WHERE user.delete_at IS NOT NULL AND user.position=0");
      }

      function getOne_User($id) {
         $API = new API();
         return $API->get_one("SELECT * FROM user WHERE id=$id");
      }

      // Login 
      function login_Employee($email, $password) {
         $API = new API();
         return $API->get_one("SELECT * FROM user WHERE email='$email' AND password='$password' AND position=1");
      } 

      // Lấy User theo email
      function getOne_UserByEmail($email) {
         $API = new API();
         return $API->get_one("SELECT user.email FROM user WHERE email='$email'");
      }

      function login_User($email, $password) {
         $API = new API();
         return $API->get_one("SELECT id, lastname, email, password FROM user WHERE email='$email' AND password='$password' AND delete_at is null");
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
   }