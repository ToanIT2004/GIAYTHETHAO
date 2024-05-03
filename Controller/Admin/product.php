<?php
$error_message = "";
$act = "product";
if (isset($_GET['act'])) {
   $act = $_GET['act'];
}

switch ($act) {
   case 'product':
      include_once "./View/admin/Product.php";
      break;
   // Link tới trang thêm sản phẩm, chi tiết
   case 'add_product':
      include_once './View/admin/addproduct.php';
      break;
   // Link tới trang chi tiết sản phẩm
   case 'product_details':
      include_once './View/Admin/Product_Details.php';
      break;
   // Link tới trang sửa chi tiết sản phẩm
   case 'update_product_details':
      include_once './View/Admin/update_product_details.php';
      break;
   // Thực hiện việc chỉnh sửa chi tiết sản phẩm
   case 'update_action':
         $id = $_POST['id'];
         $price = $_POST['price'];
         $discount = $_POST['discount'];
         $quantity = $_POST['quantity'];
         $size = $_POST['size'];
         $img1 = $_POST['hinh1'];
         $img2 = $_POST['hinh2'];
         $img3 = $_POST['hinh3'];
     
         // Kiểm tra các trường hình ảnh
         $flag = false;
     
         // Xử lý logic cập nhật sản phẩm ở đây
         include_once('../../Model/DBConfig.php');
         include_once('../../Model/API.php');
         include_once('../../Model/Product.php');
         $connect = new connect();
         $API = new API();
         $Product = new Product();
         $Product->update_ProductDetails($price, $discount, $quantity, $img1, $img2, $img3, $id);
         // Gửi phản hồi về client
         if ($flag == false) {
             $res = [
                 'status' => 200,
             ];
         } else {
             $res = [
                 'status' => 404,
                 'message' => 'Đây không phải là tệp hình ảnh',
             ];
         }
     
         // Trả về kết quả
         echo json_encode($res);
         break;
   // Link tới trang thêm chi tiết sản phẩm
   case 'add_product_details':
      include_once './View/Admin/Add_Product_Details.php';
      break;
   // Thực hiện việc thêm chi tiết sản phẩm
   case 'add_product_details_action':
      unset($_SESSION['checkForm']); 
      $flag = false;
      $errors = [];
      if (isset($_POST['detailsPro_submit'])) {
         if (isset($_GET['id'])) {
            $id = $_GET['id'];
         }
         $size_id = $_POST['size_id'];
         $price = $_POST['price'];
         $discount = $_POST['discount'];
         $quantity = $_POST['quantity'];
         $img1 = $_FILES['img1']['name'];
         $img2 = $_FILES['img2']['name'];
         $img3 = $_FILES['img3']['name'];
         $product = new Product();
         
         // Validate price
         if (empty($price)) {
            $errors['price'] = "Đơn giá không được để trống";
            $flag = true;
         } else if (!is_numeric($price)) {
            $errors['price'] = "Đơn giá phải nhập số";
            $flag = true;
         }else {
            $_SESSION['price'] = $price;
         }

         // Giá giảm không được nhập số âm
         if($discount < 0) {
            $errors['discount'] = 'Giá giảm không hợp lệ';
            $_SESSION['discount'] = $discount;
            $flag = true;
         }

         // Validate giảm giá phải nhỏ hơn đơn giá
         if($discount > $price) {
            $errors['discount'] = "Giá giảm phải nhỏ hơn đơn giá";
            $_SESSION['discount'] = $discount;
            $flag = true;
         };

         // Kiểm tra sản phẩm đã tồn tại chưa = size và tên
         $check_product = $product->getDetailsProduct_ByNameSizeID($id,$size_id);
         if($check_product) {
            $errors['size'] = "Size sản phẩm đã tồn tại";
            $_SESSION['size'] = $size;
            $flag = true;
         }


         // Tạo một mảng chứa tên của các trường ảnh 
         $image_fields = ['img1', 'img2', 'img3'];

         foreach ($image_fields as $field) {
            $img = $_FILES[$field]['name'];
            $file_path = "View/assets/img/upload/$img";

            // kiểm tra hàm mở rộng có phải là hình hay không
            // chuyển về chữ thường và lấy phần mở rộng
            $imagefileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            if ($imagefileType !== 'webp' && $imagefileType !== 'jpg' && $imagefileType !== 'jpeg' && $imagefileType !== 'png' && $imagefileType !== 'gif') {
               $flag = true;
               $errors[$field] = "Không phải là tệp hình ảnh";
            }
         }



         if ($flag == false) {
            $product->add_ProductDetails($id, $size_id, $price, $discount, $quantity, $img1, $img2, $img3);
            echo "<script>alert('Thêm sản phẩm thành công')</script>";
            // upload hình ảnh lên đường dẫn
            foreach ($image_fields as $field) {
               // $img = $_FILES[$field]['name'];
               // $file_path = "View/assets/img/upload/$img";
               $errors[$field] = "Tệp hình ảnh đã tồn tại.";
               if (!file_exists($file_path)) {

                  $sourceFilePath = $_FILES[$field]['tmp_name']; // Đường dẫn tạm thời của tệp tải lên
                  $destinationFilePath = "View/assets/img/upload/" . $_FILES[$field]['name']; // Đường dẫn đích của tệp
                  // $destinationFilePath = $_SERVER['DOCUMENT_ROOT'] . "/View/assets/img/upload/$img";
                  // Di chuyển tệp tải lên vào vị trí mong muốn
                  if (move_uploaded_file($sourceFilePath, $destinationFilePath)) {
                     echo "Tệp đã được di chuyển thành công.";
                  }
               }
            }
            echo "<meta http-equiv='refresh' content='0;url=admin.php?action=product&act=product_details&id=$id'>";
         } else {
            $_SESSION['errors'] = $errors;

            echo "<meta http-equiv='refresh' content='0;url=admin.php?action=product&act=add_product_details&id=$id'>";
         }
      }
      break;
   // Thực hiện việc xóa chi tiết sản phẩm
   case 'delete_ProductDetails':
      // ID của chi tiết sản phẩm
      if (isset($_GET['idct'])) {
         $idct = $_GET['idct'];
         // ID của sản phẩm
         if(isset($_GET['id'])) {
            $id = $_GET['id'];
         }
         $product = new Product();
         $product->delete_ProductDetails($idct);
         echo "<script>alert('Xóa sản phẩm thành công');</script>";
         echo "<meta http-equiv='refresh' content='0;url=admin.php?action=product&act=product_details&id=$id'>";
      }
   // Link tới trang chỉnh sửa sản phẩm
   case 'update_Product':
      include_once "./View/Admin/Update_Product.php";
      break;
   // Thực hiện việc chỉnh sửa sản phẩm
   case 'update_actionPro':
      $id = $_POST['id'];
      $name = $_POST['name'];
      $shoes_type_id = $_POST['shoes_type_id'];
      $brand_id = $_POST['brand_id'];
      $descriptions = $_POST['descriptions'];
      $img = $_POST['img'];
      include_once('../../Model/DBConfig.php');
      include_once('../../Model/API.php');
      include_once('../../Model/Product.php');
      $connect = new connect();
      $API = new API();
      $Product = new Product();
      $result = $Product->update_Product($id, $name, $shoes_type_id, $brand_id, $descriptions, $img);
      if($result) {
         $res = [
            'status' => 200,
            'message' => 'Thành công',
         ];
      }else {
         $res = [
            'status' => 400,
            'message' => 'Dự liệu bạn như cũ , đừng spam X X X',
         ];
      }
      echo json_encode($res);
      break;
   // Thực hiện việc thêm sản phẩm
   case 'add_action':
      $errors = [];
      $flag = false;
      if (isset($_POST['addpro_submit'])) {
         $name = $_POST['name'];
         $shoes_type_id = $_POST['shoes_type_id'];
         $brand_id = $_POST['brand_id'];
         $descriptions = $_POST['descriptions'];
         // img là tên của trường input 
         // name là một thuộc tính trong input, name="img"
         $img = $_FILES['img']['name'];

         // Session lưu lại giá trị
         // Dùng để làm chức năng khi người dùng nhập đúng thì giữ lại
         $item = [
            'name' => $name,
         ];
         $_SESSION['checkForm'] = $item;


         $file_path = "View/assets/img/upload/$img";

         // kiểm tra hàm mở rộng có phải là hình hay không
         // chuyển về chữ thường và lấy phần mở rộng
         $imagefileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
         if ($imagefileType !== 'jpg' && $imagefileType !== 'jpeg' && $imagefileType !== 'png' && $imagefileType !== 'gif' && $imagefileType !== 'webp') {
            $flag = true;
            $errors['img'] = "Không phải là tệp hình ảnh";
         }

         // Kiểm tra tên trống
         if (empty($name)) {
            $errors['name'] = "Tên không được để trống.";
            $flag = true;
         }
         if (empty($descriptions)) {
            $errors['descriptions'] = "Mô tả không được để trống.";
            $flag = true;
         }
         if (empty($img)) {
            $errors['img'] = "Vui lòng chọn tập tin.";
            $flag = true;
         }
         $product = new Product();
         // Kiểm tra trùng sản phẩm bằng tên, loại giày, thương hiệu
         $ketqua = $product->get_ProductBy($name, $shoes_type_id, $brand_id);
         if ($ketqua) {
            echo "<script>alert('Sản phẩm đã có trong database')</script>";
            echo "<meta http-equiv='refresh' content='0;url=admin.php?action=product&act=add_product'>";
            $flag = true;
         }

         if ($flag == true) {
            $_SESSION['errors'] = $errors;
         } else {
            $product->add_Product($name, $shoes_type_id, $brand_id, $descriptions, $img);
            $success_message = "Thêm sản phẩm thành công";
            $_SESSION['success_message'] = $success_message;

            // Kiểm tra file tồn tại
            if (!file_exists($file_path)) {
               // upload hình ảnh lên đường dẫn
               $sourceFilePath = $_FILES['img']['tmp_name']; // Đường dẫn tạm thời của tệp tải lên
               $destinationFilePath = "View/assets/img/upload/" . $_FILES['img']['name']; // Đường dẫn đích của tệp
               if (move_uploaded_file($sourceFilePath, $destinationFilePath)) {
                  echo "Tệp đã được di chuyển thành công.";
               }
            }
         }
         echo "<meta http-equiv='refresh' content='0;url=admin.php?action=product&act=add_product'>";
      }
      break;
   // Thực hiện việc xóa sản phẩm
   case 'delete_product':
      if (isset($_GET['id'])) {
         $id = $_GET['id'];
         $product = new Product();
         $product->delete_Product($id);
         echo "<script>alert('Xóa sản phẩm thành công')</script>";
         echo "<meta http-equiv='refresh' content='0;url=admin.php?action=product'>";
      }
      break;
   // Link tới trang chi tiết
   case 'product_detailss':
      include_once "./View/admin/themchitiet.php";
      break;
   // Thêm xóa phần brand
   case 'add_brand':
      if (isset($_POST['brand_submit'])) {
         $brand = new Brand();
         $name_brand = $_POST['name_brand'];

         // Kiểm tra xem tên thương hiệu đã tồn tại trong cơ sở dữ liệu hay chưa
         $existing_brand = $brand->get_BrandByName($name_brand);
         if ($existing_brand) {
            $error_message = "Tên thương hiệu đã tồn tại";
            $_SESSION['error_brand'] = $error_message;
         } else if (strlen($name_brand) == 0) {
            $error_message = "Hãy nhập tên thương hiệu";
            $_SESSION['error_brand'] = $error_message;
         } else {
            $brand->add_Brand($name_brand);
            echo "<script>alert('Bạn đã thêm thương hiệu thành công')</script>";
         }
         echo "<meta http-equiv='refresh' content='0;url=admin.php?action=product&act=product_detailss'>";
      }
      break;
   case 'delete_brand':
      $id = "";
      if (isset($_GET['id'])) {
         $id = $_GET['id'];

         $brand = new Brand();
         $brand->delete_Brand($id);
         echo "<script>alert('Bạn đã xóa thành công')</script>";
         echo "<meta http-equiv='refresh' content='0;url=admin.php?action=product&act=product_detailss'>";
      }
      break;
   // Thêm xóa phần loại giày
   case 'add_shoes_type':
      if (isset($_POST['shoes_type_submit'])) {
         $shoes_type = new Shoes_Type();
         $name_shoes_type = $_POST['name_shoes_type'];

         // Kiểm tra xem đã tồn tại trong cơ sở dữ liệu hay chưa
         $existing_brand = $shoes_type->get_Shoes_TypeByName($name_shoes_type);

         if ($existing_brand) {
            $error_message = "Tên giày đã tồn tại";
            $_SESSION['error_shoes_type'] = $error_message;
         } else if (strlen($name_shoes_type) == 0) {
            $error_message = "Hãy nhập tên giày";
            $_SESSION['error_shoes_type'] = $error_message;
         } else {
            $shoes_type->add_Shoes_Type($name_shoes_type);
            echo "<script>alert('Bạn đã thêm giày thành công')</script>";
         }
         echo "<meta http-equiv='refresh' content='0;url=admin.php?action=product&act=product_detailss'>";
      }
      break;
   case 'delete_shoes_type':
      $id = "";
      if (isset($_GET['id'])) {
         $id = $_GET['id'];

         $shoes_type = new Shoes_Type();
         $shoes_type->delete_Shoes_Type($id);
         echo "<script>alert('Bạn đã xóa thành công')</script>";
         echo "<meta http-equiv='refresh' content='0;url=admin.php?action=product&act=product_detailss'>";
      }
      break;
   // Thêm xóa phần loại giày
   case 'add_size':
      if (isset($_POST['size_submit'])) {
         $sizes = new size();
         $size = $_POST['size'];

         // Kiểm tra xem đã tồn tại trong cơ sở dữ liệu hay chưa
         $existing_brand = $sizes->get_sizeByName($size);

         if ($existing_brand) {
            $error_message = "Size đã tồn tại";
            $_SESSION['error_size'] = $error_message;
         } else if (strlen($size) == 0) {
            $error_message = "Hãy nhập Size";
            $_SESSION['error_size'] = $error_message;
         } else if (!is_numeric($size)) {
            $error_message = "Phải là số";
            $_SESSION['error_size'] = $error_message;
         } else {
            $sizes->add_size($size);
            echo "<script>alert('Bạn đã thêm size thành công')</script>";
         }
         echo "<meta http-equiv='refresh' content='0;url=admin.php?action=product&act=product_detailss'>";
      }
      break;
   case 'delete_size':
      $id = "";
      if (isset($_GET['id'])) {
         $id = $_GET['id'];

         $size = new size();
         $size->delete_size($id);
         echo "<script>alert('Bạn đã xóa thành công')</script>";
         echo "<meta http-equiv='refresh' content='0;url=admin.php?action=product&act=product_detailss'>";
      }
      break;
}
