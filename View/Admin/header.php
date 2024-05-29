<nav class="shadow-sm navbar navbar-expand-sm bg-light navbar-light">
    <!-- Brand -->
    <a class="navbar-brand fw-bolder text-success mx-3" href="admin.php?action=user">Zay Shop</a>

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop1" data-bs-toggle="dropdown">Quản Trị Người Dùng</a>
            <div class="dropdown-menu" style="width: 100px;">
                <a class="dropdown-item fs-14" href="admin.php?action=admin">Nhân Viên</a>
                <a class="dropdown-item fs-14" href="admin.php?action=user">Khách hàng</a>
                <a class="dropdown-item fs-14" href="admin.php?action=contact">Liên hệ<span class="rounded-border mx-1">
                    <?php 
                        $contact = new Contact();
                        $sum_contact = $contact->count_contact();
                        echo $sum_contact['dem'];
                    ?>
                </span></a>
                <a class="dropdown-item fs-14" href="admin.php?action=user&act=khoiphuc">Khôi phục</a>
            </div>
        </li>

        <!-- Quản trị Doanh Mục -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop2" data-bs-toggle="dropdown">
                Quản Trị Doanh Mục
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item fs-14" href="admin.php?action=product&act=add_product">Thêm sản phẩm</a>
                <a class="dropdown-item fs-14" href="admin.php?action=product&act=product_detailss">Thêm chi tiết</a>
                <a class="dropdown-item fs-14" href="admin.php?action=product">Sản Phẩm</a>
            </div>
        </li>
        <!-- Doanh thu -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop3" data-bs-toggle="dropdown">
                Quản trị thống kê
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item fs-14" href="admin.php?action=statistical">Doanh thu</a>
            </div>
        </li>
        <!-- Báo cáo -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop4" data-bs-toggle="dropdown">
                Quản trị đơn hàng
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item fs-14" href="admin.php?action=order">Đơn hàng<span class="rounded-border mx-1" id="count_order_wating1"></span></a>
                <a class="dropdown-item fs-14" href="admin.php?action=order_deliveried">Đã giao</a>
                <a class="dropdown-item fs-14" href="admin.php?action=order_cancel">Đã hủy</a>
            </div>
        </li>
        <!-- Báo cáo Tồn kho -->
        <li class="nav-item">
            <a class="nav-link" href="admin.php?action=login&act=dangxuat">Đăng xuất</a>
        </li>
    </ul>
</nav>

<style>
    .rounded-border {
        display: inline-block;
        padding-left: 6px;
        width: 20px;
        height: 20px;
        border: 1px solid #666;
        /* Màu và kích thước của đường viền */
        background-color: green;
        color: white;
        border-radius: 10px;
        /* Độ cong của đường viền để tạo hình tròn */
    }

    .fs-14 {
        font-size: 14px;
    }
</style>
