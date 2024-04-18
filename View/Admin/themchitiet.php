<div class="container mt-5">
   <div class="row">
      <!-- Phần thương hiệu -->
      <div class="col-lg-4">
         <form action="admin.php?action=product&act=add_brand" method="POST">
            <div class="mb-3">
               <label class="form-label">Thêm thương hiệu</label>
               <input type="text" name="name_brand" class="form-control">

               <!-- Kiểm tra nếu session tồn tại thì xuất thẻ small -->
               <?php if (isset($_SESSION['error_brand'])): ?>
                  <small id="errorBrand" class="text-danger">
                     <?php echo $_SESSION['error_brand']; ?>
                  </small>
               <?php endif ?>
            </div>
            <button name="brand_submit" type="submit" class="btn btn-primary">Thêm</button>
         </form>

         <!-- Bảng chi tiết thương hiệu -->
         <table class="table">
            <thead>
               <tr>
                  <th>STT</th>
                  <th>Tên thương hiệu</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <?php
               $brand = new Brand();
               $kq = $brand->getAll_Brand();
               $stt = 0;
               while ($set = $kq->fetch()) {
                  $stt++;
                  ?>
                  <tr>
                     <td>
                        <?php echo $stt ?>
                     </td>
                     <td>
                        <?php echo $set['name_brand'] ?>
                     </td>
                     <td>
                        <a href="admin.php?action=product&act=delete_brand&id=<?php echo $set['id'] ?>"
                           class="btn btn-danger">XÓA</a>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>

      <!-- Phần thêm loại giày -->
      <div class="col-lg-4">
         <form action="admin.php?action=product&act=add_shoes_type" method="POST">
            <div class="mb-3">
               <label class="form-label">Thêm loại giày</label>
               <input type="text" name="name_shoes_type" class="form-control">

               <!-- Kiểm tra nếu session tồn tại thì xuất thẻ small -->
               <?php if (isset($_SESSION['error_shoes_type'])): ?>
                  <small id="errorBrand" class="text-danger">
                     <?php echo $_SESSION['error_shoes_type']; ?>
                  </small>
               <?php endif ?>
            </div>
            <button name="shoes_type_submit" type="submit" class="btn btn-primary">Thêm</button>
         </form>

         <!-- Bảng chi tiết thương hiệu -->
         <table class="table">
            <thead>
               <tr>
                  <th>STT</th>
                  <th>Tên loại giày</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <?php
               $shoes_type = new Shoes_Type();
               $kq = $shoes_type->getAll_Shoes_Type();
               $stt = 0;
               while ($set = $kq->fetch()) {
                  $stt++;
                  ?>
                  <tr>
                     <td>
                        <?php echo $stt ?>
                     </td>
                     <td>
                        <?php echo $set['name'] ?>
                     </td>
                     <td>
                        <a href="admin.php?action=product&act=delete_shoes_type&id=<?php echo $set['id'] ?>"
                           class="btn btn-danger">XÓA</a>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>

      <!-- Phần thêm size -->
      <div class="col-lg-4">
         <form action="admin.php?action=product&act=add_size" method="POST">
            <div class="mb-3">
               <label class="form-label">Thêm size</label>
               <input type="text" name="size" class="form-control">

               <!-- Kiểm tra nếu session tồn tại thì xuất thẻ small -->
               <?php if (isset($_SESSION['error_size'])): ?>
                  <small id="errorBrand" class="text-danger">
                     <?php echo $_SESSION['error_size']; ?>
                  </small>
               <?php endif ?>
            </div>
            <button name="size_submit" type="submit" class="btn btn-primary">Thêm</button>
         </form>

         <!-- Bảng chi tiết thương hiệu -->
         <table class="table">
            <thead>
               <tr>
                  <th>STT</th>
                  <th>Kích thước</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <?php
               $size = new size();
               $kq = $size->getAll_size();
               $stt = 0;
               while ($set = $kq->fetch()) {
                  $stt++;
                  ?>
                  <tr>
                     <td>
                        <?php echo $stt ?>
                     </td>
                     <td>
                        <?php echo $set['size'] ?>
                     </td>
                     <td>
                        <a href="admin.php?action=product&act=delete_size&id=<?php echo $set['id'] ?>"
                           class="btn btn-danger">XÓA</a>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>
</div>

<script>

   // Hàm sau 5s nó sẽ tự xóa lỗi
   // thương hiệu
   setTimeout(() => {
      var errorBrand = document.getElementById('errorBrand');
      errorBrand.parentNode.removeChild(errorBrand);
      <?php unset($_SESSION['error_brand']) ?>
   }, 5000)
   // loại giày
   setTimeout(() => {
      var errorBrand = document.getElementById('errorBrand');
      errorBrand.parentNode.removeChild(errorBrand);
      <?php unset($_SESSION['error_shoes_type']) ?>
   }, 5000)
   // thương hiệu
   setTimeout(() => {
      var errorBrand = document.getElementById('errorBrand');
      errorBrand.parentNode.removeChild(errorBrand);
      <?php unset($_SESSION['error_size']) ?>
   }, 5000)

   // Confirm hỏi xem chắc chắn chưa
   function del() {
      return confirm('Bạn đã chắc chắn xóa chưa')
   }
</script>