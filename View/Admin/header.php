
<header class="row no-gutters">
    <!-- nav san pham -->
    <section class="col-12" style="height:40px;">
        <div class="col-12">
            <div class="row">

                <!-- test -->
                <nav class="navbar navbar-expand-sm bg-light navbar-light">
                    <!-- Brand -->
                    <a class="navbar-brand" href="#">Logo</a>

                    <!-- Links -->
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                Quản Trị Người Dùng
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="admin.php?action=user">Khách hàng</a>
                                <a class="dropdown-item" href="admin.php?action=contact">Liên hệ<span class="rounded-border mx-1">
                                    <?php 
                                        $contact = new Contact();
                                        $result_contact = $contact->count_contact()->fetch();
                                        echo $result_contact['dem']
                                    ?>
                                </span></a>
                                <a class="dropdown-item" href="admin.php?action=user&act=khoiphuc">Khôi phục</a>
                            </div>
                        </li>
                        
                        <!-- Quản trị Doanh Mục -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                Quản Trị Doanh Mục
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="admin.php?action=product&act=add_product">Thêm sản phẩm</a>
                                <a class="dropdown-item" href="admin.php?action=product&act=product_detailss">Thêm chi tiết</a>
                                <a class="dropdown-item" href="admin.php?action=product">Sản Phẩm</a>
                                <a class="dropdown-item" href="#">Loại menu</a>
                            </div>
                        </li>
                        <!-- Thống kê -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                Thống Kê
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Sản Phẩm bán được nhiều Nhất</a>
                                <a class="dropdown-item" href="#">Sản Phẩm chưa được giao</a>
                                <a class="dropdown-item" href="#">Sản phẩm bán ít nhất</a>
                                <a class="dropdown-item" href="">Thống kê</a>
                            </div>
                        </li>
                        <!-- Báo cáo -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                Quản trị đơn hàng
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="admin.php?action=order">Đơn hàng
                                    <span class="rounded-border mx-1">
                                        <?php 
                                            $Order = new Order();
                                            $result_contact = $Order->getAll_WaitOrder()->fetch();
                                            echo $result_contact['total_orders'];
                                        ?>
                                    </span>
                                </a>
                                <a class="dropdown-item" href="admin.php?action=order&act=deliveried">Đã giao</a>
                                <a class="dropdown-item" href="#">Hủy đơn</a>
                            </div>
                        </li>
                        <!-- Báo cáo Tồn kho -->
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php?action=login&act=dangxuat">Đăng xuất</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </section>
</header>

<style>
    .rounded-border {
        display: inline-block;
        padding-left: 6px;
        width: 20px;
        height: 20px;
        border: 1px solid #666; /* Màu và kích thước của đường viền */
        background-color: green;
        color: white;
        border-radius: 10px; /* Độ cong của đường viền để tạo hình tròn */
    }
</style>