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
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- end -->
    <!-- end link đăng nhập -->
    <link rel="stylesheet" type="text/css" href="./View/assets/css/Tour.css" />
    <title>Admin SanPham</title>
</head>

<body>
    <!-- Thanh header tao menu -->
    <?php
    if (isset($_SESSION['username']) && $_SESSION['password']) {
        include_once "View/admin/header.php";
    }
    ?>
    <div class="container">
        <div class="row">
            <?php
            $ctrl = "login";
            if (isset($_GET['action'])) {
                if(isset($_SESSION['username']) && $_SESSION['password']) {
                    $ctrl = $_GET['action'];
                }
            }else {
                echo "<script>window.location.replace('admin.php?action=login');</script>";
            }
            include_once "Controller/Admin/$ctrl.php";
            ?>
        </div>
    </div>
    <script src="ajax/Product.js"></script>
    <script src="ajax/User.js"></script>
    <script src="ajax/login.js"></script>
    <script src="ajax/Contact.js"></script>
    <script src="ajax/Order.js"></script>
    <script src="./View/assets/ajax/upload_img1.js"></script>
    <!-- <script src="./View/assets/ajax/upload_img2.js"></script>
    <script src="./View/assets/ajax/upload_img3.js"></script> -->

        
</body>

</html>


