<h1 class="mt-3 mb-3 text-success fw-bolder text-center">Thông Tin Nhân Viên</h1>
<div class="col-lg-12">
   <div class="d-flex justify-content-end">
      <button data-bs-toggle="modal" data-bs-target="#modal_add_admin" class="btn btn-outline-info mb-2"><i
            class="bi bi-plus-circle"></i></button>
   </div>
   <table class="table table-bordered">
      <thead class="table-info">
         <tr class="text-center">
            <th>Mã NV</th>
            <th>Họ Tên</th>
            <th>Tài khoản</th>
            <th>Mật khẩu</th>
            <th>Số điện thoại</th>
            <th></th>
         </tr>
      </thead>
   </table>
</div>

<!-- Modal Thêm Nhân Viên -->
<div class="modal fade" id="modal_add_admin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title text-success fw-bold fs-5" id="exampleModalLabel">Thêm Nhân Viên</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form id="form_add_admin">
            <div class="modal-body">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="" class="form-label fw-bolder">Họ Tên</label>
                           <input name="emp_name" id="emp_name" type="text" class="form-control">
                           <small id="emp_name" class="badge text-danger"></small>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="" class="form-label fw-bolder">Ngày làm việc</label>
                           <input name="emp_start_date" type="text" id="datepicker"
                              class="form-control" placeholder="Chọn ngày">
                           <small id="datepicker" class="badge text-danger"></small>

                        </div>

                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="" class="form-label fw-bolder">Tài Khoản</label>
                           <input name="emp_username" id="emp_username" type="text" class="form-control">
                           <small id="emp_username" class="badge text-danger"></small>

                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="" class="form-label fw-bolder">Mật khẩu</label>
                           <input name="emp_password" id="emp_password" type="text" class="form-control">
                           <small id="emp_password" class="badge text-danger"></small>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="" class="form-label fw-bolder">Số điện thoại</label>
                           <input name="emp_phone" id="emp_phone" type="text" class="form-control">
                           <small id="emp_phone" class="badge text-danger"></small>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <label for="" class="form-label fw-bolder">Vai trò</label>
                        <select name="emp_role" id="emp_role" class="form-select" aria-label="Default select example">
                           <option selected disabled value="">Chức vụ</option>
                           <?php
                           $admin = new admin();
                           $adm = $admin->get_all_role();
                           while ($set = $adm->fetch()):
                              ?>
                              <option value="<?php echo $set['role_id']?>"><?php echo $set['role_name']?></option>
                           <?php endwhile ?>
                        </select>
                        <small id="emp_role" class="badge text-danger"></small>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success">Thêm</button>
            </div>
         </form>
      </div>
   </div>
</div>

<script>
   flatpickr("#datepicker", {
      dateFormat: "d-m-Y"
   });
</script>