<div class="container mt-5">
   <div class="row">
      <div class="col-lg-10 offset-md-1">
         <div class="card">
            <div class="card-header">
               <h4 class="text-center text-info">CHỈNH SỬA CHI TIẾT SẢN PHẨM</h4>
            </div>
            <div class="card-body">
               <form id="formProduct_Details" enctype="multipart/form-data">
                  <div>
                     <input type="hidden" id="id" value="">
                     <div class="d-flex justify-content-between mb-3">
                        <div>
                           <label class="form-label">Đơn giá</label>
                           <input id="price" type="text" name="price" placeholder="Nhập đơn giá" style="width: 350px" class="form-control">
                           <small id="price_error" class="text-danger"></small>
                        </div>
                        <div>
                           <label class="form-label">Giảm giá</label>
                           <input id="discount" type="text" class="form-control" style="width: 350px">
                           <small id="discount_error" class="text-danger"></small>
                        </div>
                     </div>

                     <div class="d-flex justify-content-between mb-3">
                        <div>
                           <label class="form-label">Số lượng tồn</label>
                           <input value="1" min="1" type="number" id="quantity" placeholder="Nhập đơn giá" style="width: 350px" class="form-control">
                           <small id="quantity_error" class="text-danger"></small>
                        </div>
                        <div>
                           <label class="form-label">Size</label>
                           <input disabled id="size" type="text" class="form-control" style="width: 350px">
                        </div>
                     </div>


                     <div class="d-flex justify-content-between mb-3">
                        <div class="form-group mb-3">
                           <label class="form-label">Hình phụ 1</label>
                           <input style="width: 350px" type="file" id="img1" class="form-control">
                           <img id="preview_img1" value="" alt="Preview Image" style="max-width: 100px; max-height: 100px;">
                           <a id="upload_img1" class="btn btn-primary">Cập nhật ảnh</a>
                        </div>
                        <div class="form-group mb-3">
                           <label class="form-label">Hình phụ 2</label>
                           <input style="width: 350px" type="file" id="img2" class="form-control">
                           <img id="preview_img2" value="" alt="Preview Image" style="max-width: 100px; max-height: 100px;">
                        </div>
                     </div>

                     <div class="form-group mb-3">
                        <label class="form-label">Hình phụ 3</label>
                        <input type="file" id="img3" class="form-control">
                        <img id="preview_img3" value="" alt="Preview Image" style="max-width: 100px; max-height: 100px;">
                     </div>
                     <small id="img_error" class="text-danger"></small>
                     <button name="detailsPro_submit" type="submit" class="btn btn-primary w-100">Thêm</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Đổ dữ liệu theo ID -->
<?php 
   if(isset($_GET['idct'])) {
      $idct = $_GET['idct'];  
   }
   $product = new Product();
   $kq = $product->get_ProductDetailsBySize($idct);
?>

<script>
   $(document).ready(() => { 
      productDetails = <?php echo json_encode($kq)?>;
      $('#id').val(productDetails.id);
      $('#price').val(productDetails.price);
      $('#discount').val(productDetails.discount);
      $('#quantity').val(productDetails.quantity);
      $('#size').val(productDetails.size);
      $('#preview_img1').attr('src', "./View/assets/img/upload/" + productDetails.img1); 
      $('#preview_img2').attr('src', "./View/assets/img/upload/" + productDetails.img2); 
      $('#preview_img3').attr('src', "./View/assets/img/upload/" + productDetails.img3); 
      $('#preview_img1').val(productDetails.img1); 
      $('#preview_img2').val(productDetails.img2); 
      $('#preview_img3').val(productDetails.img3); 

      
   })
</script>