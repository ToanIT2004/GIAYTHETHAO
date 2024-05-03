<!-- Modal -->
<div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="w-100 pt-1 mb-5 text-right">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="get" class="modal-content modal-body border-0 p-0">
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                <button type="submit" class="input-group-text bg-success text-light">
                    <i class="fa fa-fw fa-search text-white"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img style="height: 500px" class="img-fluid" src="./View/assets/img/upload/slide_2_img.webp" alt="">
        </div>
        <div class="carousel-item">
            <img style="height: 500px" class="img-fluid" src="./View/assets/img/upload/slide_8_img.webp" alt="">
        </div>
        <div class="carousel-item">
            <img style="height: 500px; width: 100%" class="img-fluid"
                src="./View/assets/img/upload/kham-pha-lich-su-cac-logo3.jpg" alt="">
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
        role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
        role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->

<h2  class="chophighlight text-center">Chúng tôi khuyến khích bạn mua hàng bằng tài khoản để có cơ hội trở thành khách hàng thân thuộc của chúng tôi</h2>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-6">
            <img style="border-radius: 10px; height: 533px" class="w-100" src="View/assets/img/upload/messi.jpg" alt="">
        </div>
        <div class="col-lg-6">
            <img style="border-radius: 10px" class="w-100" src="View/assets/img/upload/neymar.webp" alt="">
        </div>
    </div>
</div>
<!-- Start Categories of The Month -->
<section class="container-fluid py-5">
    <div class="d-flex justify-content-between">
        <div class="col-lg-6">
            <h2>TẤT CẢ SẢN PHẨM</h2>
        </div>
        <div class="col-lg-6">
            <div class="d-flex justify-content-end">
                <span class="mt-1 mx-4">Sắp xếp theo:</span>
                <select id="arrange_select" class="w-50 form-select" aria-label="Default select example">
                    <option <?php echo ((isset($_GET['act']) && $_GET['act'] == 'home') || (isset($_GET['action']) && $_GET['action'] == 'home')) ? 'selected' : ''; ?> value="0">Tất cả sản phẩm</option>
                    <option <?php echo isset($_GET['act']) && $_GET['act'] == 'futsal' ? 'selected' : ''; ?> value="1">Giày Futsal</option>
                    <option <?php echo isset($_GET['act']) && $_GET['act'] == 'football' ? 'selected' : ''; ?> value="2">Giày Cỏ Nhân Tạo</option>
                    <option <?php echo isset($_GET['act']) && $_GET['act'] == 'decrease' ? 'selected' : ''; ?> value="3">Giá: giảm dần</option>
                    <option <?php echo isset($_GET['act']) && $_GET['act'] == 'ascending' ? 'selected' : ''; ?> value="4">Giá: tăng dần</option>
                </select>

            </div>
        </div>
    </div>
    <div class="row">
        <?php
        $product = new Product();
        if(isset($_GET['act']) && $_GET['act'] == 'futsal') {
            $result_product = $product->getAll_ShoesFutsal();
        }else if(isset($_GET['act']) && $_GET['act'] == 'football') {
            $result_product = $product->getAll_ShoesFootball();
        }else if(isset($_GET['act']) && $_GET['act'] == 'decrease') {
            $result_product = $product->getPrice_Decrease();
        }else if(isset($_GET['act']) && $_GET['act'] == 'ascending') {
            $result_product = $product->getPrice_Ascending();
        }else {
            $result_product = $product->getProduct_ByNamePriceDiscount();
        }
        while ($result_set = $result_product->fetch()):
            ?>
        <div class="col-lg-3 mb-3">
            <a href="index.php?action=details_product&id=<?php echo $result_set['id']?>"><img class="mb-3 image" style="width: 16.5rem; border-radius: 30px" src="View/assets/img/upload/<?php echo $result_set['img']?>" alt=""></a>
            <a href="index.php?action=details_product&id=<?php echo $result_set['id']?>" class="fw-bold text-secondary text-decoration-none fs-6" style="min-height: 55px"><?php echo $result_set['name']?></a>
            <div class="d-flex mx-5">
                <?php 
                    if($result_set['discount'] > 0) {
                        echo "<span class='fs-6 text-danger fw-bold mx-1'>".number_format($result_set['discount'])."đ</span>";
                        echo "<span class='fs-6 text-secondary fw-bolder mx-1 text-decoration-line-through'>".number_format($result_set['price'])."đ</span>";
                    }else {
                        echo "<span class='fs-6 text-danger fw-bold mx-1'>".number_format($result_set['price'])."đ</span>";
                    }
                ?>
            </div>
        </div>
        <?php endwhile ?>
    </div>
</section>

<style>
    .image:hover {
        transform: scale(1.05);
        transition: 0.2s;
    }

    @keyframes chophighlight {
        0% { color: white; text-shadow: 0 0 5px white; }
        50% { color: black; text-shadow: 0 0 5px black; }
        100% { color: white; text-shadow: 0 0 5px white; }
    }

    .chophighlight {
        animation: chophighlight 2s infinite;
    }

    .fw-bolder {
        cursor: pointer;
    }

</style>