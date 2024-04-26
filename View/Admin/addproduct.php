<div class="container mt-5">
  <div class="row">
    <!-- Thêm sản phẩm -->
    <div class="col-lg-10 offset-md-1">
      <div class="card">
        <div class="card-header text-center">
          <b class="text-info">THÊM SẢN PHẨM</b>
        </div>
        <div class="card-body">
            <form action="admin.php?action=product&act=add_action" method="POST" enctype="multipart/form-data">
            <div class="form-group mb-4">
              <label class="form-label">Tên sản phẩm</label>

              <input placeholder="Nhập tên sản phẩm" name="name" type="text" 
              value="<?php echo isset($_SESSION['errors']) && isset($_SESSION['checkForm']['name']) ? $_SESSION['checkForm']['name'] : '' ?>" class="form-control">  
            

              <?php
              if (isset($_SESSION['errors']['name'])):
                ?>
                <small id="errors" class="text-danger">
                  <?php echo $_SESSION['errors']['name'] ?>
                </small>
              <?php endif; ?>
            </div>

            <div class="d-flex justify-content-between mb-3">
              <div>
                <label class="form-label">Tên loại giày</label>
                <select name="shoes_type_id" style="width: 350px" class="form-select form-select-lg mb-3"
                  aria-label="Large select example">
                  <?php 

                    $shoes_type = new Shoes_Type();
                    $kq = $shoes_type->getAll_Shoes_Type();
                    $selected = -1;
                    if(isset($shoes_type_id)) {
                      $selected = $shoes_type_id;
                    }
                    while ($set = $kq->fetch()):
                  ?>
                    <option value="<?php echo $set['id'] ?>" <?php echo $set['id'] === $selected ? 'selected': ''?>>
                      <?php echo $set['name'] ?>
                    </option>
                  <?php endwhile ?>
                
                </select>
              </div>
              <div>
                <label class="form-label">Tên thương hiệu</label>
                <select name="brand_id" style="width: 350px" class="form-select form-select-lg mb-3"
                  aria-label="Large select example">
                  <?php
                  $brand = new Brand();
                  $kq = $brand->getAll_Brand();
                  $selected = -1;
                  if(isset($brand_id)) {
                      $selected = $brand_id;
                  }
                  while ($set = $kq->fetch()):
                    ?>
                    <option value="<?php echo $set['id'] ?>" <?php echo $set['id'] === $selected ? 'selected': ''?>>
                      <?php echo $set['name_brand'] ?>
                    </option>

                  <?php endwhile ?>
                </select>
              </div>
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Mô tả</label>
              <textarea placeholder="Nhập mô tả" class="form-control" name="descriptions" cols="30" rows="5"></textarea>
              
              <?php
              if (isset($_SESSION['errors']['descriptions'])):
                ?>
                <small id="errors" class="text-danger">
                  <?php echo $_SESSION['errors']['descriptions'] ?>
                </small>
              <?php endif; ?>
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Hình ảnh</label>
              <input type="file" name="img" class="form-control" value="<?php echo isset($img)?$img:''?>">
              <?php
              if (isset($_SESSION['errors']['img'])):
                ?>
                <small id="errors" class="text-danger">
                  <?php echo $_SESSION['errors']['img'] ?>
                </small>
              <?php endif; ?>
            </div>
            <button name="addpro_submit" class="btn btn-primary w-100">Thêm</button>

            <?php
            if (isset($_SESSION['success_message'])) {
              echo "<small class='text-success' id='successMessage'>" . $_SESSION['success_message'] . "</small>";
            }
            ?>
          </form>
        </div>
      </div>
    </div>
</div>
<!-- Phần thêm sản phẩm -->
  <!-- Nếu tồn tại session['errors'] thì sẽ tự xóa sau 5s -->
  <?php if (isset($_SESSION['errors'])): ?>
    <script>
      setTimeout(() => {
        var errors = document.querySelectorAll('.text-danger');
        if (errors.length > 0) {
          errors.forEach(function (error) {
            error.parentNode.removeChild(error);
          });
        }
        <?php unset($_SESSION['errors']) ?>; // Dời câu lệnh này ra khỏi trong setTimeout
      }, 5000);
    </script>
  <?php endif ?>

  <script>
    // Xóa session sau 5 giây của trường hợp thành công
    //Sản phẩm
    setTimeout(() => {
      var successMessage = document.getElementById('successMessage');
      successMessage.parentNode.removeChild(successMessage);
      <?php unset($_SESSION['success_message']); ?>
    }, 5000); // Thời gian tính bằng mili giây (5 giây = 5000 mili giây)


    // Sau 5s nó sẽ xóa session['checkForm']
    setTimeout(() => {
      console.log('Chay roi');
      <?php unset($_SESSION['checkForm'])?>
    }, 5000)
  </script>
