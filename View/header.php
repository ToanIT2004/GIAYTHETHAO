<?php
//Lấy ra thông tin người đăng nhập nếu tồn tại
if (isset($_SESSION['user_id'])) {
   $user = new User();
   $is_SS = false;
   $users = $user->getUserInfoPDW_ByID($_SESSION['user_id'])->fetchAll();
   foreach ($users as $userss) {
      if ($userss['role'] == 1) {
         $_SESSION['fullname'] = $userss['fullname'];
         $_SESSION['number_phone'] = $userss['number_phone'];
         $_SESSION['address'] = $userss['address'];
         $_SESSION['province'] = $userss['province'];
         $_SESSION['district'] = $userss['district'];
         $_SESSION['wards'] = $userss['wards'];
         $_SESSION['district_id'] = $userss['province_id'];
         $_SESSION['district_id'] = $userss['district_id'];
         $_SESSION['wards_id'] = $userss['wards_id'];
         $is_SS = true;
      }
   }

   if ($is_SS == false) {
      unset($_SESSION['fullname']);
      unset($_SESSION['number_phone']);
      unset($_SESSION['address']);
      unset($_SESSION['province']);
      unset($_SESSION['district']);
      unset($_SESSION['wards']);
      unset($_SESSION['province_id']);
      unset($_SESSION['district_id']);
      unset($_SESSION['wards_id']);
   }
}
?>

<!-- Start Top Nav -->
<nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
   <div class="container text-light">
      <div class="w-100 d-flex justify-content-between">
         <div>
            <i class="fa fa-envelope mx-2"></i>
            <a class="navbar-sm-brand text-light text-decoration-none"
               href="mailto:info@company.com">chuongtoan1602@gmail.com</a>
            <i class="fa fa-phone mx-2"></i>
            <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">070-303-8870</a>
         </div>
         <div>

            <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i
                  class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
            <a class="text-light" href="https://www.instagram.com/" target="_blank"><i
                  class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
            <a class="text-light" href="https://twitter.com/" target="_blank"><i
                  class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
            <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i
                  class="fab fa-linkedin fa-sm fa-fw"></i></a>
         </div>
      </div>
   </div>
</nav>
<!-- Close Top Nav -->


<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light shadow">
   <div class="container d-flex justify-content-between align-items-center">

      <a class="navbar-brand text-success logo h1 align-self-center" href="index.php?action=home">
         Zay
      </a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
         data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
         aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>

      <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
         id="templatemo_main_nav">
         <?php
         if (isset($_GET['action'])) {
            $action = $_GET['action'];
         }
         ?>
         <div class="flex-fill">
            <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
               <li class="nav-item">
                  <a class="nav-link fw-bolder <?php echo (isset($_GET['action']) && $_GET['action'] == 'home') ? 'text-success' : '' ?>"
                     href="index.php?action=home">Trang chủ</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link fw-bolder <?php echo (isset($_GET['action']) && $_GET['action'] == 'shop') ? 'text-success' : '' ?>"
                     href="index.php?action=shop">Sản phẩm</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link fw-bolder <?php echo (isset($_GET['action']) && $_GET['action'] == 'contact') ? 'text-success' : '' ?>"
                     href="index.php?action=contact">Liên hệ</a>
               </li>
            </ul>
         </div>
         <div class="navbar align-self-center d-flex">
            <a class="nav-icon position-relative text-decoration-none" href="index.php?action=cart">
               <i
                  class="fa fa-fw fa-cart-arrow-down text-dark mr-1 <?php echo (isset($_GET['action']) && $_GET['action'] == 'cart') ? 'text-success' : '' ?>"></i>
               <span id="totalCart"
                  class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
            </a>
            <?php if (isset($_SESSION['lastname'])) { ?>
               <div class="dropdown">
                  Hi ,<span data-bs-toggle="dropdown" style="cursor: pointer;"
                     class="text-secondary profile position-relative"><?php echo $_SESSION['lastname'] ?>!</span>
                  <ul style="margin-left: -20px;" class="dropdown-menu">
                     <li>
                        <a class="dropdown-item" href="index.php?action=info_user">
                           <i style="font-size: 15px;" class="text-secondary bi bi-person-bounding-box"></i>
                           <span class="mx-1 fw-bolder" style="font-size: 12px;">Thông tin</span>
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="index.php?action=order_history">
                           <i style="font-size: 15px;" class="text-secondary bi bi-card-checklist"></i>
                           <span class="mx-1 fw-bolder" style="font-size: 12px;">Lịch sử mua hàng</span>
                        </a>
                     </li>
                     <li>
                        <a href="index.php?action=change_password" id="change_password" class="dropdown-item">
                           <i style="font-size: 15px;" class="text-secondary bi bi-key"></i>
                           <span class="mx-1 fw-bolder" style="font-size: 12px;">Đổi mật khẩu</span>
                        </a>
                     </li>
                     <li><?php if (isset($_SESSION['lastname'])): ?>
                           <a class="dropdown-item" href="index.php?action=user&act=logout_User">
                              <i style="font-size: 15px;" class="text-secondary bi bi-box-arrow-right"></i>
                              <span class="mx-1 fw-bolder" style="font-size: 12px;">Đăng xuất</span>
                           </a>
                        <?php endif ?>
                     </li>
                  </ul>
               </div>
            <?php } else { ?>
               <div class="dropdown">
                  <i style="cursor: pointer;" data-bs-toggle="dropdown"
                     class="fa fa-fw fa-user text-dark mr-3 <?php echo (isset($_GET['action']) && $_GET['action'] == 'User') ? 'text-success' : '' ?>"></i>
                  <ul class="dropdown-menu" style="margin-left: -50px">
                     <li>
                        <a class="dropdown-item" href="index.php?action=User&act=login">
                           <span class="mx-1 fs-6">Đăng nhập</span>
                        </a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="index.php?action=User&act=register">
                           <span class="mx-1 fs-6">Đăng ký</span>
                        </a>
                     </li>
                  </ul>
               </div>
            <?php } ?>
         </div>
      </div>
   </div>
</nav>

<style>

</style>