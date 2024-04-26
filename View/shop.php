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

<!-- Start Content -->
<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <h1 class="h2 pb-4">Sản phẩm</h1>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6 pb-4">
                    <span>Loại giày</span>
                    <div class="d-flex">
                        <select id="shoes_type_id" class="form-control">
                            <?php 
                                $shoes_type = new Shoes_Type();
                                $shoes_type_result = $shoes_type->getAll_Shoes_Type();
                                while($shoes_type_set = $shoes_type_result->fetch()):
                            ?>
                            <option value="<?php echo $shoes_type_set['id']?>"><?php echo $shoes_type_set['name']?></option>
                            <?php endwhile?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 pb-4">
                    <span>Thương hiệu</span>
                    <div class="d-flex">
                        <select id="brand_id" class="form-control">
                            <?php 
                                $brand = new Brand();
                                $brand_result = $brand->getAll_Brand();
                                while($brand_set = $brand_result->fetch()):
                            ?>
                            <option value="<?php echo $brand_set['id']?>"><?php echo $brand_set['name_brand']?></option>
                            <?php endwhile?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" id="product_table">
                  <!-- Đoạn này nó chạy ở dưới js -->
            </div>
        </div>
    </div>
</div>
<!-- End Content -->

<!-- Start Brands -->
<section class="bg-light py-5">
    <div class="container my-4">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Our Brands</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    Lorem ipsum dolor sit amet.
                </p>
            </div>
            <div class="col-lg-9 m-auto tempaltemo-carousel">
                <div class="row d-flex flex-row">
                    <!--Controls-->
                    <div class="col-1 align-self-center">
                        <a class="h1" href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="text-light fas fa-chevron-left"></i>
                        </a>
                    </div>
                    <!--End Controls-->

                    <!--Carousel Wrapper-->
                    <div class="col">
                        <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="multi-item-example"
                            data-bs-ride="carousel">
                            <!--Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">

                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="./View/assets/img/brand_01.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="./View/assets/img/brand_02.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="./View/assets/img/brand_03.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="./View/assets/img/brand_04.png" alt="Brand Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End First slide-->

                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="./View/assets/img/brand_01.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="./View/assets/img/brand_02.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="./View/assets/img/brand_03.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="./View/assets/img/brand_04.png" alt="Brand Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End Second slide-->

                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="./View/assets/img/brand_01.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="./View/assets/img/brand_02.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="./View/assets/img/brand_03.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="./View/assets/img/brand_04.png" alt="Brand Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End Third slide-->

                            </div>
                            <!--End Slides-->
                        </div>
                    </div>
                    <!--End Carousel Wrapper-->

                    <!--Controls-->
                    <div class="col-1 align-self-center">
                        <a class="h1" href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="text-light fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <!--End Controls-->
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Brands-->


<!-- Đổ dữ liệu ra và lọc bằng filter -->
<?php 
    $product = new Product();
    $product_result = $product->getProduct_ByNamePriceDiscount()->fetchAll();
?>
<script>
    const products = <?php echo json_encode($product_result)?>;
    function filterProduct() {
        // Lấy value
        const shoes_type = $('#shoes_type_id').val();
        const brand = $('#brand_id').val();

        // Thực hiện việc lọc
        const filteredProducts = products.filter(product => {
            return (shoes_type == product.shoes_type_id && brand == product.brand_id)
        });
        // Xóa các sản phẩm hiện có
        $('#product_table').empty();
        // Gắn vào sản phẩm
        const tableBody = $('#product_table')
        filteredProducts.forEach(product => {
            // Định dạng lại giá tiền Việt Nam
            let formattedPrice = numeral(product.price).format('0,0');
            let formattedDiscount = numeral(product.discount).format('0,0');
    const productItem = `
    <div class="col-md-4">
        <div class="card mb-4 product-wap rounded-0">
            <div class="card rounded-0">
                <img class="card-img rounded-0 img-fluid" src="./View/assets/img/upload/${product.img}">
                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                    <ul class="list-unstyled">
                        <li><a class="btn btn-success text-white" href="shop-single.html"><i class="far fa-heart"></i></a></li>
                        <li><a id="Product_id" data-product-id="${product.id}" class="btn btn-success text-white mt-2" href="index.php?action=details_product&id=${product.id}"><i class="far fa-eye"></i></a></li>
                        <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="fas fa-cart-plus"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body" style="min-height: 180px;">
                <a href="shop-single.html" class="h3 text-decoration-none">${product.name}</a>
                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                    <li class="pt-2">
                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                        <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                        <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                        <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                        <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                    </li>
                </ul>
                <ul class="list-unstyled d-flex justify-content-center mb-1">
                    <li>
                        <i class="text-warning fa fa-star"></i>
                        <i class="text-warning fa fa-star"></i>
                        <i class="text-warning fa fa-star"></i>
                        <i class="text-muted fa fa-star"></i>
                        <i class="text-muted fa fa-star"></i>
                    </li>
                </ul>
                <div class="d-flex">
                    ${formattedDiscount == 0 ? `<p class="text-center mx-5 fw-bold text-danger mb-0">${formattedPrice}đ</p>` : `
                    <p class="text-center mx-1 fw-bolder text-decoration-line-through mb-0">${formattedPrice}đ</p>
                    <p class="text-center text-danger mx-1 fw-bold mb-0">${formattedDiscount}đ</p>
                    `}
                </div>
            </div>
        </div>
    </div>`;
    tableBody.append(productItem);
});
    }
    // Khi click option thì nó sẽ load lại 
    $('#shoes_type_id, #brand_id').change(filterProduct);

    // gọi nó chạy lần đầu tiên khi bật lên
    filterProduct();
</script>