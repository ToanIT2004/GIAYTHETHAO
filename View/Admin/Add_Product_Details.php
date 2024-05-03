<div class="container mt-5">
   <div class="row">
      <div class="col-lg-12 offset-md-2">
         <!-- Thêm chi tiết sản phẩm -->
         <div class="col-lg-8">
            <div class="card">
               <div class="card-header text-center">
                  <b class="text-info">THÊM CHI TIẾT SẢN PHẨM</b>
               </div>
               <div class="card-body">
                  <?php 
                     if(isset($_GET['id'])) {
                        $id = $_GET['id'];
                     }
                  ?>
                  <form action="admin.php?action=product&act=add_product_details_action&id=<?php echo $id?>" method="POST"
                     enctype="multipart/form-data">
                     <div>
                        <div class="form-group">
                           <label class="form-label">Sản phẩm</label>
                           <?php
                           $Product = new Product();

                           $kq = $Product->get_ProductByID($id);
                           ?>
                           <input disabled type="text" class="form-control"
                              placeholder="<?php echo $kq['name'] . "        ||        " . $kq['shoes_type_name'] . "        ||         " . $kq['brand_name'] ?>">
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                           <div>
                              <label class="form-label">Đơn giá</label>
                              <input value="<?php echo isset($_SESSION['errors']) && isset($_SESSION['price'])?$_SESSION['price']:''?>" 
                              type="text" name="price" placeholder="Nhập đơn giá" style="width: 265px"
                                 class="form-control">

                              <?php if (isset($_SESSION['errors']['price'])): ?>
                                 <small class="text-danger"><?php echo $_SESSION['errors']['price'] ?></small>
                              <?php endif ?>
                           </div>
                           <div>
                              <label class="form-label">Giảm giá</label>
                              <input value="<?php echo isset($_SESSION['errors']) && isset($_SESSION['discount'])?$_SESSION['discount']:0?>"  type="text" name="discount" style="width: 265px" class="form-control" value="0">
                              <?php if (isset($_SESSION['errors']['discount'])): ?>
                                 <small class="text-danger"><?php echo $_SESSION['errors']['discount'] ?></small>
                              <?php endif ?>
                           </div>
                        </div>

                        <div class="d-flex justify-content-between">
                           <div class="form-group">
                              <label class="form-label">Số lượng tồn</label>
                              <input type="number" name="quantity" min="1" value="1" style="width: 265px"
                                 placeholder="Nhập số lượng tồn" class="form-control">
                           </div>
                           <div>
                              <label class="form-label">Size</label>
                              <select name="size_id" style="width: 265px" class="form-select form-select-lg mb-3"
                                 aria-label="Large select example">
                                 <?php
                                 $size = new size();
                                 $kichthuoc = $size->getAll_size();
                                 while ($set = $kichthuoc->fetch()):
                                    ?>
                                    <option value="<?php echo $set['id'] ?>"><?php echo $set['size'] ?></option>
                                 <?php endwhile ?>
                              </select>
                              <?php if (isset($_SESSION['errors']['size'])): ?>
                                 <small class="text-danger"><?php echo $_SESSION['errors']['size'] ?></small>
                              <?php endif ?>
                           </div>
                        </div>


                        <div class="d-flex justify-content-between mb-3">
                           <div class="form-group mb-3">
                              <label class="form-label">Hình phụ 1</label>
                              <input style="width: 265px" type="file" name="img1" class="form-control">
                              <?php
                              if (isset($_SESSION['errors']['img1'])):
                                 ?>
                                 <small class="text-danger"><?php echo $_SESSION['errors']['img1'] ?></small>
                              <?php endif ?>
                           </div>
                           <div class="form-group mb-3">
                              <label class="form-label">Hình phụ 2</label>
                              <input style="width: 265px" type="file" name="img2" class="form-control">
                              <?php
                              if (isset($_SESSION['errors']['img2'])):
                                 ?>
                                 <small class="text-danger"><?php echo $_SESSION['errors']['img3'] ?></small>
                              <?php endif ?>
                           </div>
                        </div>

                        <div class="form-group mb-3">
                           <label class="form-label">Hình phụ 3</label>
                           <input type="file" name="img3" class="form-control">
                           <?php
                           if (isset($_SESSION['errors']['img3'])):
                              ?>
                              <small class="text-danger"><?php echo $_SESSION['errors']['img3'] ?></small>
                           <?php endif ?>
                        </div>
                        <button name="detailsPro_submit" type="submit" class="btn btn-primary w-100">Thêm</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php if (isset($_SESSION['errors'])): ?>
    <script>
      setTimeout(() => {
        var errors = document.querySelectorAll('.text-danger');
        if (errors.length > 0) {
          errors.forEach(function (error) {
            error.parentNode.removeChild(error);
          });
        }
      }, 5000);
    </script>
    <?php unset($_SESSION['errors']) ?>
<?php endif ?>

<script>
   setTimeout(() => {
      console.log('Đã chạy');
      <?php unset($_SESSION['price'])?>
   }, 5000) 
</script>