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
         return $API->get_All("SELECT * FROM `user` WHERE user.delete_at IS NOT NULL");
      }

      function getOne_User($id) {
         $API = new API();
         return $API->get_one("SELECT * FROM user WHERE id=$id");
      }

      // Lấy User theo email
      function getOne_UserByEmail($email) {
         $API = new API();
         return $API->get_one("SELECT user.email FROM user WHERE email='$email'");
      }

      function login_User($email, $password) {
         $API = new API();
         return $API->get_one("SELECT email, password FROM user WHERE email='$email' AND password='$password'");
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
   }