<?php 
   if(!empty($_FILES['file1'])) {
      // đường link chứa ảnh
      $target_dir = "../View/assets/img/upload/";
      // lấy tên hình
      $target_file = $target_dir . basename($_FILES['file1']['name']);

      // biến phần mở rộng của file thành chữ thường
      $imageFileType = strtolower(pathinfo($_FILES['file1']['name'], PATHINFO_EXTENSION));

      $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif', 'webp');

      if(file_exists($target_file)) {
         $res = [
            'status' => 200,
            'message' => 'Upload thành công!!!',
            'data' => './View/assets/img/upload/' . $_FILES['file1']['name'],
         ];
         echo json_encode($res);
      }else {
         if(move_uploaded_file($_FILES['file1']['tmp_name'], $target_file)) {
            $res = [
               'status' => 200,
               'message' => 'Upload thành công!!!',
               'data' => './View/assets/img/upload/' . $_FILES['file1']['name'],
            ];
            echo json_encode($res);
         }
      }
   }