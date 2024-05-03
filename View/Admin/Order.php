<?php 
   $id = 123; // Gán giá trị cố định cho biến $id
?>
<div class="container-xxl mt-5">
   <div class="row">
      <span class="fs-3 mb-3  ">Bạn đang có 
         <b class="text-danger">
            <?php 
               $Order = new Order();
               $count_order = $Order->getAll_WaitOrder()->fetch();
               echo $count_order['total_orders'];
            ?>
         </b> 
         đơn hàng đang chờ xử lý...</span>
      <div class="col-lg-12">
         <table class="table">
            <thead class="table-danger">
               <tr>
                  <th>Mã đơn hàng</th>
                  <th>Khách hàng</th>
                  <th>Số điện thoại</th>
                  <th>Địa chỉ</th>
                  <th>Phường</th>
                  <th>Quận</th>
                  <th>Thành Phố</th>
                  <th>Đặt hàng</th>
                  <?php 
                     if(!isset($_GET['act'])) {
                        echo '<th>Đang giao</th>';
                     }
                  ?>
                  <?php 
                     if(isset($_GET['act']) && $_GET['act'] == 'deliveried') {
                        echo '<th>Đã giao</th>';
                     }
                  ?>
                  <th>Tình trạng</th>
               </tr>
            </thead>
            <tbody>
               <?php 
                  $stt = 0;
                  $Order = new Order();
                  if(isset($_GET['action']) && $_GET['action'] == 'order' && !isset($_GET['act'])) {
                     $Result_Orders = $Order->getAll_Order();
                  }else if(isset($_GET['action']) && $_GET['action'] == 'order' && isset($_GET['act']) && $_GET['act'] == 'deliveried') {
                     $Result_Orders = $Order->getAll_Order1();
                  }
                  while($Result_set = $Result_Orders->fetch()):
                     $stt++
               ?>
               <tr>
                  <td><?php echo $stt?></td>
                  <td>
                     <span><?php echo $Result_set['fullname']?></span> <br>
                  </td>
                  <td>0<?php echo $Result_set['number_phone']?></td>
                  <td><?php echo $Result_set['address']?></td>
                  <td><?php echo $Result_set['wards']?></td>
                  <td><?php echo $Result_set['district']?></td>
                  <td><?php echo $Result_set['province']?></td>
                  <td><?php echo $Result_set['create_at']?></td>

                  <?php if(!isset($_GET['act'])) {?>
                     <td><?php echo $Result_set['delivery_time']?></td>
                  <?php }?>

                  <?php if(isset($_GET['act']) && $_GET['act'] == 'deliveried') {?>
                  <td><?php echo $Result_set['delivered_time']?></td>
                  <?php }?>

                  <td>
                     <a style="width: 100px" class="btn btn-primary mb-3" href="admin.php?action=order&act=details&id=<?php echo $Result_set['order_id']?>">Chi tiết</a>
                     <?php 
                        if(!isset($_GET['act'])):
                     ?>
                     <select data-orderid="<?php echo $Result_set['order_id']?>" id="select_option" style="width: 100px" class="form-select bg-info text-white form-select-lg mb-3" aria-label="Large select example">
                        <option value="" disabled selected>Chờ xử lý</option>
                        <?php 
                           $status = new status();
                           $result_status = $status->getAll_Status();
                           while($result_set = $result_status->fetch()):
                        ?>
                        <option value="<?php echo $result_set['id']?>" <?php echo $Result_set['status'] == $result_set['id']? 'selected': '' ?>>
                           <?php echo $result_set['status']?>
                        </option>
                        <?php endwhile?>
                     </select>
                     <?php endif?>
                  </td>
               </tr>
               <?php endwhile?>
            </tbody>
         </table>
      </div>
   </div>
</div>