<div class="container">
   <?php
   if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
   }
   $order = new Order();
   $count_order = $order->order_history_id($user_id)->rowCount();
   if ($count_order == 0) {
      echo "<h1 class='text-secondary mb-3 mt-3 text-center'>Không có lịch sử</h1>";
   } else {
      echo "<h3 class='text-dark text-center fw-bold mb-3 mt-3'>Lịch Sử Đơn Hàng</h3>";
   }
   ?>
   <div class="row" id="table_order_history">
      <input id="user_id" type="hidden" value="<?php echo $_SESSION['user_id'] ?>">
   </div>
</div>


<!-- Modal Order Details -->
<div class="modal fade" id="modal_order_details" tabindex="-1" aria-labelledby="modal_order_details" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title text-success">Chi tiết Đơn hàng</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <!-- ajax -->
         <div class="modal-body table_order_details1">
         </div>
         <div class="modal-footer">
            <span class="fw-bolder">Tổng: <b id="sum_price_order" class="text-danger"></b></span>
         </div>
      </div>
   </div>
</div>