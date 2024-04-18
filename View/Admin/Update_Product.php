<div class="container mt-5">
   <div class="row">
      <!-- Thêm sản phẩm -->
      <div class="col-lg-10 offset-md-1">
         <div class="card">
            <div class="card-header text-center">
               <b class="text-info">CHỈNH SỬA SẢN PHẨM</b>
            </div>
            <div class="card-body">
               <form id="form_Product">
                  <input type="hidden" id="id_product">
                  <div class="form-group mb-3">
                     <label class="form-label">Tên sản phẩm</label>
                     <input id="name_product" type="text" class="form-control">
                     <small id="name_product_error" class="text-danger"></small>
                  </div>

                  <div class="d-flex justify-content-between">
                     <div class="form-group">
                        <label class="form-label">Tên loại giày</label>
                        <select id="shoes_type" style="width: 350px" class="form-select form-select-lg mb-3"
                           aria-label="Large select example">
                           <?php 
                              $shoes_type_id = new Shoes_Type();
                              $kq = $shoes_type_id->getAll_Shoes_Type();
                              while($set = $kq->fetch()):
                           ?>
                           <option value="<?php echo $set['id']?>"><?php echo $set['name']?></option>
                           <?php endwhile?>
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Tên thương hiệu</label>
                        <select id="brand" style="width: 350px" class="form-select form-select-lg mb-3"
                           aria-label="Large select example">
                           <?php 
                              $brand = new Brand();
                              $kq = $brand->getAll_Brand();
                              while($set = $kq->fetch()):
                           ?>
                           <option value="<?php echo $set['id']?>" ><?php echo $set['name_brand']?></option>
                           <?php endwhile?>
                        </select>
                     </div>
                  </div>

                  <div class="form-group mb-3">
                     <label class="form-label">Mô tả</label>
                     <textarea id="descriptions_product" class="form-control" name="" id="" cols="30" rows="5"></textarea>
                     <small id="descriptions_product_error" class="text-danger"></small>
                  </div>

                  <div class="form-group mb-3">
                     <label class="form-label">Hình ảnh</label>
                     <!-- <input type="file" id="img" class="form-control"> -->
                     <div class="d-flex">
                       <label for="file"> <img style="width: 200px; height: 200px" value="" id="prevent_img" src="" alt=""> </label>
                        <span id="img_error" class="text-danger mx-5"></span>
                     </div>
                     <!--  -->
                     <input type="text" id="link_url" value="" hidden name="link_url">
                     <input type="file" id="file" hidden accept=".png,.jpeg,.jpg,.gif,.webp" name="avatar">
                     <div id="upload_img" class="btn btn-primary mb-3 ">cập nhật hình</div>
                     <!--  -->
                  </div>

                  <button class="btn btn-primary">Chỉnh sửa</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<?php 
   if(isset($_GET['id'])) {
      $id = $_GET['id'];
   }
   $product = new Product();
   $result = $product->getByID_Product($id);
?>

<script>
   $(document).ready(() => {
      product = <?php echo json_encode($result)?>;
      $('#id_product').val(product.id);
      $('#name_product').val(product.name);
      $('#descriptions_product').val(product.descriptions);
      $('#shoes_type').val(product.shoes_type_id);
      $('#brand').val(product.brand_id);
      $('#prevent_img').attr('src', "./View/assets/img/upload/" + product.img); 
      $('#link_url').attr('value', "./View/assets/img/upload/" + product.img); 
   })
</script>