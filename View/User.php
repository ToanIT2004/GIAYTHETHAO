<div class="container mt-5 mb-5">
   <div class="row">
      <div class="col-lg-6 offset-md-3">
         <?php
         if (isset($_GET['action']) && isset($_GET['act']) && $_GET['act'] == 'register') {
            echo "<form id='register' class='form shadow p-3 mb-5 bg-body-tertiary rounded'>";
            echo '<h2 class="form-title">Đăng ký</h2>';
         } else {
            echo "<form id='formLogin_User' class='form shadow p-3 mb-5 bg-body-tertiary rounded'>";
            echo '<h2 class="form-title">Đăng nhập</h2>';
         }

         if (isset($_GET['action']) && isset($_GET['act']) && $_GET['act'] == 'register'):
            ?>
            <div class="d-flex justify-content-between mt-3">
               <div class="input-container">
                  <label for="">Họ</label>
                  <input id="firstname" name="firstname" style="width: 190px" type="text" placeholder="Nhập họ">
                  <small id="firstname_error" class="text-danger"></small>
               </div>
               <div class="input-container">
                  <label for="">Tên</label>
                  <input id="lastname" name="lastname" style="width: 140px" type="text" placeholder="Nhập tên">
                  <small id="lastname" class="text-danger"></small>
               </div>
            </div>
         <?php endif; ?>
         <div class="input-container">
            <label for="">Gmail</label>
            <input id="email" name="email" type="email" placeholder="Nhập email">
            <small id="email_error" class="text-danger"></small>
         </div>
         <div class="input-container">
            <label for="">Mật khẩu</label>
            <input id="password" name="password" type="password" placeholder="Nhập password">
            <small id="password_error" class="text-danger"></small>
         </div>
         <?php
         if (isset($_GET['action']) && isset($_GET['act']) && $_GET['act'] == 'register') {
            ?>
            <div class="input-container">
               <label for="">Nhập Lại Mật khẩu</label>
               <input id="confirm_password" name="confirm_password" type="password" placeholder="Nhập lại password">
               <small id="confirm_password_error" class="text-danger"></small>
            </div>
         <?php } ?>

         <?php
         if (isset($_GET['action']) && isset($_GET['act']) && $_GET['act'] == 'login') {
            echo '<button name="login_submit" type="submit" class="submit">Đăng nhập</button>';
         } else {
            echo '<button type="submit" class="submit">Đăng ký</button>';
         }
         ?>


         <p class="signup-link">
            Bạn đã có tài khoản?
            <?php
            if (isset($_GET['action']) && isset($_GET['act']) && $_GET['act'] == 'register') {
               ?>
               <a class="text-decoration-none" href="index.php?action=user&act=login">Đăng nhập</a>
            <?php } else { ?>
               <a class="text-decoration-none" href="index.php?action=user&act=register">Đăng ký</a>
            <?php } ?>
         </p>

         <?php 
           if (isset($_GET['action']) && isset($_GET['act']) && $_GET['act'] == 'login') {
         ?>
         <!-- Button trigger modal -->
         <a type="button" class="text-primary text-decoration-none" style="margin-left: 120px;" data-bs-toggle="modal" data-bs-target="#exampleModal">Quên mật khẩu</a>
         <?php }?>
         </form>
      </div>
   </div>
   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">Lấy lại mật khẩu</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <form id="Form_Mail">
                     <label for="" class="form-label">Email</label>
                     <input id="confirm_email" placeholder="Nhập email của bạn" type="text" class="form-control"></input>
                     <small id="confirm_email_error" class="text-danger"></small> <br>
                     <button type="submit" class="btn btn-secondary mt-3">Gửi</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<style>
   .input-error {
      border: 1px solid red;
   }

   .form {
      background-color: #fafafa;
      display: block;
      padding: 1rem;
      max-width: 390px;
      border-radius: 0.5rem;
   }

   .form-title {
      font-size: 1.25rem;
      line-height: 1.75rem;
      font-weight: 600;
      text-align: center;
      color: #000;
   }

   .input-container {
      position: relative;
   }

   .input-container input,
   .form button {
      outline: none;
      border: 1px solid #e5e7eb;
      margin: 8px 0;
   }

   .input-container input {
      background-color: #fff;
      padding: 1rem;
      padding-right: 3rem;
      font-size: 0.875rem;
      line-height: 1.25rem;
      width: 350px;
      border-radius: 0.5rem;
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
   }

   .submit {
      display: block;
      padding-top: 0.75rem;
      padding-bottom: 0.75rem;
      padding-left: 1.25rem;
      padding-right: 1.25rem;
      background-color: #4F46E5;
      color: #ffffff;
      font-size: 0.875rem;
      line-height: 1.25rem;
      font-weight: 500;
      width: 100%;
      border-radius: 0.5rem;
      text-transform: uppercase;
   }

   .signup-link {
      color: #6B7280;
      font-size: 0.875rem;
      line-height: 1.25rem;
      text-align: center;
   }

   .signup-link a {
      text-decoration: underline;
   }
</style>
