<div class="container mt-5 mb-5">
   <div class="row">
      <div class="col-lg-12">
         <table class="table">
            <thead>
               <tr>
                  <th>Sản phẩm</th>
                  <th>Đơn giá</th>
                  <th>Số lượng</th>
                  <th>Thành tiền</th>
               </tr>
            </thead>
            <tbody>
               <?php
               if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                  ?>
                  <?php
                  foreach ($_SESSION['cart'] as $cart):
                     ?>
                     <tr>
                        <td>
                           <div class="d-flex">
                              <div class="mx-1">
                                 <img style="widht: 150px; height: 150px; border-radius: 10px;"
                                    src="View/assets/img/upload/<?php echo $cart['img'] ?>" alt="Image">
                              </div>
                              <div class="mx-1">
                                 <span><?php echo $cart['name'] ?></span> <br>
                                 <span class="fs-6"><?php echo $cart['shoes_type'] . " - " . $cart['brand'] ?></span> <br>
                                 <span id="size" class="fs-6"><?php echo 'Size: ' . $cart['size'] ?></span> <br>
                                 <div class="d-flex justify-content-between">
                                    <span data-repo_id="<?php echo $cart['idsp']; ?>" class="fs-6 repo_cart">Kho: </span> <br>
                                    <small data-idsp="<?php echo $cart['idsp']; ?>" class="idsp text-danger"></small> <br>
                                 </div>

                                 <button id="drop_ItemCart" value="<?php echo $cart['idsp'] ?>" class="btn btn-secondary"><i
                                       class="bi bi-trash3"></i></button>
                              </div>
                           </div>
                        </td>
                        <td><?php echo number_format($cart['price']) ?>đ</td>
                        <td class="text-center">
                           <div class="d-flex">
                              <button data-id="<?php echo $cart['idsp']?>" class="fs-4 btn decrease_cart">-</button>
                              <span data-id="<?php echo $cart['idsp']?>" class="mt-2 quantity_cart"><?php echo $cart['quantity']?></span>
                              <button data-id="<?php echo $cart['idsp']?>" class="btn increase_cart">+</button>  
                           </div>
                        </td>
                        <td>
                           <?php echo number_format($cart['price'] * $cart['quantity']) ?>đ</td>
                     </tr>
                  <?php endforeach ?>
                  <tr>
                     <td colspan='3'>Tổng tiền</td>
                     <?php
                     $sum = 0;
                     foreach ($_SESSION['cart'] as $cart) {
                        $sum += $cart['price'] * $cart['quantity'];
                     }
                     ?>
                     <td class="text-danger">
                        <h6 class="total_price"><?php echo number_format($sum); ?>đ</h6>
                     </td>
                  </tr>
               <?php } else {
                  echo "<tr><td colspan='4'>Giỏ hàng đang trống</td></tr>"; // Hiển thị thông báo nếu giỏ hàng trống
               } ?>
            </tbody>
         </table>

         <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
               Thanh Toán
            </button>
         <?php } ?>

         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h1 class="modal-title fs-4 text-success" id="exampleModalLabel">Xác nhận đơn hàng</h1> <br>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <input type="hidden" id="user_id" value="<?php echo isset($_SESSION['user_id'])?$_SESSION['user_id']:0?>">
                     <div class="form-group mb-3">
                        <label for="" class="mb-1">Họ tên khách hàng</label>
                        <input type="text" id="fullname" class="form-control" placeholder="Điền họ tên của bạn">
                     </div>
                     <div class="form-group mb-3">
                        <label for="" class="mb-1">Số điện thoại</label>
                        <input type="text" id="number_phone" class="form-control" placeholder="Điền số điện của bạn">
                        <small id="numberphone_error" class="text-danger"></small>
                     </div>
                     <div class="form-group mb-3">
                        <label for="" class="mb-1">Địa chỉ</label>
                        <input type="text" id="address" class="form-control" placeholder="Điền địa chỉ của bạn">
                     </div>

                     <div class="d-flex justify-content-between">
                        <div class="form-group">
                           <label for="wards">Tỉnh/Thành</label>
                           <select style="width: 140px" class="form-control" name="province" id="province">
                              <option value=>Chọn tỉnh/thành</option>
                              <?php 
                                 $Address = new Address_Order();
                                 $Address_Result = $Address->getAll_Province();
                                 while($Address_set = $Address_Result->fetch()):
                              ?>
                              <option value="<?php echo $Address_set['province_id']?>"><?php echo $Address_set['name']?></option>
                              <?php endwhile?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="wards">Quận/Huyện</label>
                           <select style="width: 140px" class="form-control" name="district" id="district">
                              <option value=>Chọn quận/huyện</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="wards">Phường/Xã</label>
                           <select style="width: 140px" class="form-control" name="wards" id="wards">
                              <option value=>Chọn phường/xã</option> 
                           </select>
                        </div>
                     </div>
                     <div class="d-flex justify-content-between mt-4">
                        <span class="h3 fs-4">Tổng tiền</span>
                        <span class="h3 text-danger fs-4"><?php echo number_format($sum); ?>đ</span>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                     <button type="button" id="form_Order" class="btn btn-primary">Xác nhận</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>