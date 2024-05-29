<?php
header('Content-Type: text/html; charset=utf-8');
include "./Model/DBConfig.php";
include "./Model/API.php";
include "./Model/Brand.php";
include "./Model/Shoes_Type.php";
include "./Model/Size.php";
include "./Model/Product.php";
include "./Model/User.php";
include "./Model/Order.php";
include "./Model/Contact.php";
include "./Model/Status.php";
include "./Model/Statistical.php";
include "./Model/Admin.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin SanPham</title>

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/8tibevqzcyx0osfvfv6bxnzs7jmyqxoccp7ylzezhp6388fj/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    <!-- jQuery (Ensure it's loaded if you use it) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <!-- Popper.js (for Bootstrap 5) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>

    <!-- Bootstrap 5 JS (Bundle includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://unpkg.com/sweetalert2@11"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="./View/assets/css/Tour.css" />

    <!-- Datetimepicker css -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>
    <!-- Thanh header tao menu -->
    <?php
    if (isset($_SESSION['username']) && $_SESSION['password']) {
        include_once "View/admin/header.php";
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php
            $ctrl = "login";
            if (isset($_GET['action'])) {
                if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                    $ctrl = $_GET['action'];
                }
            } else {
                echo "<script>window.location.replace('admin.php?action=login');</script>";
            }
            include_once "./Controller/Admin/$ctrl.php";
            ?>
        </div>
    </div>
    <script src="ajax/Product.js"></script>
    <script src="ajax/User.js"></script>
    <script src="ajax/login.js"></script>
    <script src="ajax/Contact.js"></script>
    <script src="ajax/Order.js"></script>
    <script src="./View/assets/ajax/upload_img1.js"></script>
    <script src="./View/assets/ajax/upload_img.js"></script>
    <script src="ajax/validate.js"></script>
    <script src="ajax/Info_user.js"></script>
    <script src="ajax/admin.js"></script>
</body>

</html>