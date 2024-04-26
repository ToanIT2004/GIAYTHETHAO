<div class="container mt-3">
   <h3 class="text-center">KHÁCH HÀNG LIÊN HỆ</h3>
   <div class="row">
      <div class="col-lg-12">
         <table class="table table-bordered">
            <thead class="table-success">
               <tr>
                  <td>Họ tên</td>
                  <td>Số điện thoại</td>
                  <td>Email</td>
                  <td>Nội dung</td>
                  <td>Thời gian</td>
                  <td>Trạng thái</td>
               </tr>
            </thead>
            <tbody class="">
               <?php 
                  $contact = new Contact();
                  $Result_contact = $contact->getAll_Contact();
                  while($Result_set = $Result_contact->fetch()):
               ?>
               <tr>
                  <input id="contact_id" type="hidden" value="<?php echo $Result_set['id']?>">
                  <td><?php echo $Result_set['fullname']?></td>
                  <td><?php echo $Result_set['email']?></td>
                  <td><?php echo $Result_set['number_phone']?></td>
                  <td><?php echo $Result_set['content']?></td>
                  <td><?php echo $Result_set['create_at']?></td>
                  <td>
                     <button data-contact_id="<?php echo $Result_set['id']?>" type="button" class="btn btn-outline-success update_status"><?php echo $Result_set['status']?></button> <bR>
                     <button data-contact_id="<?php echo $Result_set['id']?>" type="button" class="btn btn-outline-danger delete_contact"><i class="bi bi-trash3-fill"></i></button>
                  </td>
               </tr>
               <?php endwhile?>
            </tbody>
         </table>
      </div>
   </div>
</div>