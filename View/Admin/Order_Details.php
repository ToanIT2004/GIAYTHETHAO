<?php if(isset($_GET['act']) && $_GET['act'] == 'details'): ?>

<div class="container mt-5">
   <div class="row">
      <span class="h3 text-center">CHI TIẾT ĐƠN</span>
      <div class="col-lg-12">
         <table class="table table-bordered">
            <thead class="table-primary">
               <tr>
                  <td>Tên sản phẩm</td>
                  <td>Tổng giá</td>
               </tr>
            </thead>
            <tbody>
               <?php 
                  if(isset($_GET['id']) && isset($_GET['act'])) {
                     $id = $_GET['id'];
                  }
                  $Order = new Order();
                  $Result_Order = $Order->getAll_DetailsOrderByID($id);
                  while($Result_set = $Result_Order->fetch()):
               ?>
               <tr>
                  <td>
                     <div class="d-flex">
                        <img style="width: 100px; height: 100px; border-radius: 10px" src="View/assets/img/upload/<?php echo $Result_set['img']?>" alt="">
                        <div class="mx-5">
                           <span><?php echo $Result_set['name_product']?></span> <br>
                           <span>Size: <?php echo $Result_set['size']?></span> <br>
                           <span>Số lượng: <?php echo $Result_set['quantity']?></span> <br>
                           <span>Đơn giá: <?php echo number_format($Result_set['price'])?>đ</span>
                        </div>
                     </div>
                  </td>
                  <td class="text-center">
                     <b><?php echo number_format($Result_set['total_price'])?>đ</b>
                  </td>
               </tr>
               <?php endwhile?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?php endif?>