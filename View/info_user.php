<div class="container mt-5 mb-5">
   <h2 class="text-center fw-bold mb-5">THÔNG TIN CÁ NHÂN</h2>
   <?php
      $user = new User();
      if (isset($_SESSION['user_id'])) {
         $user_id = $_SESSION['user_id'];
      }
      $get_avatar = $user->get_avatar_id($user_id);
   ?>
   <div class="row">
      <div class="col-lg-5">

         <!-- Form thông tin cá nhân người dùng -->
         <form id="form_user_details">
            <h3 class="text-success fw-bold">Hồ sơ của bạn</h3>
            <?php
            $user = new user();
            $info_user = $user->getOne_User($user_id);

            // Extract day, month, and year from the birthday
            $birthday = $info_user['birthday'];
            $day = date('d', strtotime($birthday));
            $month = date('m', strtotime($birthday));
            $year = date('Y', strtotime($birthday));
            ?>
            <div class="d-flex">
               <div class="mb-3">
                  <label class="form-label fs-6">Họ</label>
                  <input id="firstname" type="text" class="form-control shadow-sm"
                     value="<?php echo $info_user['firstname'] ?>"
                     style="height: 40px;width: 220px;" id="exampleInputEmail1">
                  <small id="firstname_error" class="badge text-danger"></small>
               </div>
               <div class="mb-3 mx-4">
                  <label class="form-label fs-6">Tên</label>
                  <input id="lastname" type="text" class="form-control shadow-sm"
                     value="<?php echo $info_user['lastname'] ?>" style="height: 40px;width: 120px;"
                     id="exampleInputEmail1">
                  <small id="lastname_error" class="badge text-danger"></small>
               </div>
            </div>
            <div class="mb-3">
               <label class="form-label">Số điện thoại</label>
               <input id="number_phone" type="text" class="form-control shadow-sm"
                  style="height: 40px;" value="<?php echo isset($info_user['number_phone'])?'0'.$info_user['number_phone']:'' ?>">
               <small id="number_phone_error" class="badge text-danger"></small>
            </div>
            <div class="mb-3">
               <label class="form-label">Email</label>
               <input id="email" disabled type="text" class="form-control shadow-sm"
                  style="height: 40px;" value="<?php echo $info_user['email'] ?>">
            </div>
            <div class="mb-3">
               <label class="form-label">Giới tính: </label>
               <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                  <input type="radio" value="Nam" class="btn-check" name="btnradio" id="btnradio1"
                        <?php echo ($info_user['gender'] == 'Nam') ? 'checked' : ''; ?>>
                  <label class="btn btn-outline-secondary mx-2 fs-6" style="height: 35px;width: 60px;border-radius: 100px;" for="btnradio1">Nam</label>

                  <input type="radio" value="Nữ" class="btn-check" name="btnradio" id="btnradio2"
                        <?php echo ($info_user['gender'] == 'Nữ') ? 'checked' : ''; ?>>
                  <label class="btn btn-outline-secondary mx-2 fs-6" style="height: 35px;width: 50px;border-radius: 100px;" for="btnradio2">Nữ</label>

                  <input type="radio" value="Khác" class="btn-check" name="btnradio" id="btnradio3"
                        <?php echo ($info_user['gender'] == 'Khác') ? 'checked' : ''; ?>>
                  <label class="btn btn-outline-secondary mx-2 fs-6" style="height: 35px;width: 60px;border-radius: 100px;" for="btnradio3">Khác</label>
               </div> <br>
               <small id="gender_error" class="mx-5 mt-1 badge text-danger"></small>
            </div>

            <div class="mb-3">
               <label class="form-label">Ngày sinh:</label>
               <div class="d-flex justify-content-between">
                  <select id="day" style="width: 115px;" class="form-select" aria-label="Default select example">
                     <?php for ($i = 1; $i <= 31; $i++) { ?>
                        <option <?php echo ($day == $i)?'selected':''?> value='<?php echo $i ?>'><?php echo $i ?></option>
                     <?php } ?>
                  </select>
                  <select id="month" style="width: 115px;" class="form-select" aria-label="Default select example">
                     <?php for ($i = 1; $i <= 12; $i++) { ?>
                        <option <?php echo ($month == $i)?'selected':''?> value='<?php echo $i ?>'>Tháng <?php echo $i ?></option>

                     <?php } ?>
                  </select>
                  <select id="year" style="width: 115px;" class="form-select" aria-label="Default select example">
                     <?php for ($i = 2023; $i >= 1950; $i--) { ?>
                        <option <?php echo ($year == $i)?'selected':''?> value='<?php echo $i ?>'><?php echo $i ?></option>
                     <?php } ?>
                  </select>

               </div>
            </div>
            <button type="submit" class="btn btn-success">Lưu</button>
         </form>
      </div>
      <div class="col-lg-1"></div>
      <div class="col-lg-6">
         <!-- Avatar -->

         <img style="width: 140px; height: 140px;" class="rounded-circle mb-3 offset-md-4" id="preview_avatar"
            src="./View/assets/img/avatar/<?php echo ($get_avatar) ? $get_avatar['avatar'] : 'avatar-trang-4.jpg' ?>"
            alt="">
         <form id="save_avatar">
            <div class="d-flex justify-content-center">
               <input name="user_id" id="user_id" type="hidden" value="<?php echo $_SESSION['user_id'] ?>">
               <input class="form-control d-none" style="width: 116px;" accept="image/png, image/gif, image/jpeg, image/webp" type="file" name="avatar" id="avatar">
               <label class="btn btn-outline-success" for="avatar">Chọn ảnh</label>
               <button type="submit" class="btn mx-5"><i class="bi bi-floppy-fill"></i></button>
            </div>
            <small id="avatar_error" style="margin-left: 75px;" class="badge text-danger"></small>
         </form>



         <h6 class="text-dark fw-bold mt-5 mb-4">Chọn địa chỉ nhận hàng: </h6>
         <!-- Đổ dữ liệu thông tin khách hàng theo id ở đây -->
         <div id="table_address_user"></div>

         <button id="add_address_user" class="btn btn-white text-success d-flex justify-content-center w-100">
            <i class="bi bi-plus-circle"></i>
            <span class="mx-2">Thêm địa chỉ mới</span>
         </button>

         <!-- Modal thêm địa chỉ mới -->
         <div class="modal fade" id="address_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h1 class="modal-title fs-5" id="exampleModalLabel">Địa chỉ mới</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <form id="form_info_user1">
                        <input name="user_id" type="hidden" value="<?php echo $_SESSION['user_id'] ?>">
                        <div class="form-group mb-3">
                           <label for="" class="form-label">Họ tên</label>
                           <input value="" id="fullname" name="fullname" class="form-control" type="text"
                              placeholder="Nhập họ tên">
                           <small id="fullname_error" class="text-danger badge"></small>
                        </div>

                        <div class="form-group mb-3">
                           <label for="" class="form-label">Số điện thoại</label>
                           <input value="" id="numberphone" name="numberphone" class="form-control" type="text"
                              placeholder="Nhập số điện thoại">
                           <small id="numberphone_error" class="text-danger badge"></small>
                        </div>

                        <div class="form-group mb-3">
                           <label for="" class="form-label">Địa chỉ</label>
                           <input value="" id="address" name="address" class="form-control" placeholder="Nhập địa chỉ"
                              type="text">
                           <small id="address_error" class="text-danger badge"></small>
                        </div>

                        <div class="d-flex justify-content-between">
                           <div class="form-group">
                              <label for="wards">Tỉnh/Thành</label>
                              <select style="width: 150px" class="form-control" name="province" id="province">
                                 <option value=>Chọn tỉnh/thành</option>
                                 <?php
                                 $Address = new Address_Order();
                                 $Address_Result = $Address->getAll_Province();
                                 while ($Address_set = $Address_Result->fetch()):
                                    ?>
                                    <option value="<?php echo $Address_set['province_id'] ?>">
                                       <?php echo $Address_set['name'] ?>
                                    </option>
                                 <?php endwhile ?>
                              </select>
                              <small style="font-size: 12px;" id="province_error" class="text-danger badge"></small>
                           </div>
                           <div class="form-group">
                              <label for="wards">Quận/Huyện</label>
                              <select style="width: 150px" class="form-control" name="district" id="district">
                                 <option value="">
                                    Chọn quận/huyện
                                 </option>
                              </select>
                              <small style="font-size: 12px;" id="district_error" class="text-danger badge"></small>

                           </div>
                           <div class="form-group">
                              <label for="wards">Phường/Xã</label>
                              <select style="width: 150px" class="form-control" name="wards" id="wards">
                                 <option value="">
                                    Chọn phường/xã
                                 </option>
                              </select>
                              <small style="font-size: 12px;" id="wards_error" class="text-danger badge"></small>
                           </div>
                        </div>

                        <button type="submit" class="btn btn btn-outline-secondary w-100 mt-3">Hoàn thành</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>