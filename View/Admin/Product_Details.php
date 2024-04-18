<div class="container mt-5">
   <h2 class="text-dark">CHI TIẾT SẢN PHẨM</h2>
   <div class="row">
      <div class="col-lg-12">
         <div class="d-flex justify-content-around">
            <?php
            $Product = new Product();
            if (isset($_GET['id'])) {
               $id = $_GET['id'];
            }
            $kq = $Product->get_ProductByID($id);
            ?>
            <h4 class="fs-4">Tên món hàng: <b class="text-danger"><?php echo $kq['name'] ?></b></h4>
            <h4 class="fs-4">Loại giày: <b class="text-danger"><?php echo $kq['shoes_type_name'] ?></b></h4>
            <h4 class="fs-4">Thương hiệu: <b class="text-danger"><?php echo $kq['brand_name'] ?></h4>
            <a href="admin.php?action=product&act=add_product_details&id=<?php echo $id?>" class="btn btn-info">Thêm chi tiết</a>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <table class="table">
            <thead>
               <tr class="table-primary">
                  <th>STT</th>
                  <th>Giá</th>
                  <th>Giá giảm</th>
                  <th>Size</th>
                  <th>Số lượng tồn</th>
                  <th>Hình phụ 1</th>
                  <th>Hình phụ 2</th>
                  <th>Hình phụ 3</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <?php
               $Product = new Product();
               $stt = 0;
               if (isset($_GET['id'])) {
                  $id = $_GET['id'];
               }
               $id = $_GET['id'];
               $kq = $Product->get_ProductDetailsByID($id);
            
               while ($set = $kq->fetch()):  
                  $stt++
                  ?>
                  <tr>
                     <td><?php echo $stt ?></td>
                     <td><?php echo number_format($set['price']) ?>đ</td>
                     <td><?php echo number_format($set['discount']) ?>đ</td>
                     <td><?php echo $set['size']?></td>
                     <td><?php echo $set['quantity'] ?></td>
                     <td>
                        <img style="width: 100px; height: 80px" src="View/assets/img/upload/<?php echo $set['img1'] ?>"
                           alt="">
                     </td>
                     <td>
                        <img style="width: 100px; height: 80px" src="View/assets/img/upload/<?php echo $set['img2'] ?>"
                           alt="">
                     </td>
                     <td>
                        <img style="width: 100px; height: 80px" src="View/assets/img/upload/<?php echo $set['img3'] ?>"
                           alt="">
                     </td>
                     <td>
                        <a href="admin.php?action=product&act=update_product_details&idct=<?php echo $set['id']?>" class="btn btn-warning mb-1">Chỉnh sửa</a> <br>
                        <a href="admin.php?action=product&act=delete_ProductDetails&idct=<?php echo $set['id'];?>&id=<?php echo $id;?>"
                           class="btn btn-danger mt-1">Xóa</a>
                     </td> 
                  </tr>
               <?php endwhile ?>
            </tbody>
         </table>
      </div>
   </div>
</div>

<style>
   .form-label {
      color: black;
   }
</style>
