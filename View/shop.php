<!-- Start Content -->
<div class="container py-5">
    <div class="row">

        <!-- <div class="col-lg-3">
            <h1 class="h2 pb-4">Sản phẩm</h1>
        </div> -->

        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-6 pb-4">
                    <span>Loại giày</span>
                    <div class="d-flex">
                        <select id="shoes_type_id" class="form-control">
                            <?php
                            $shoes_type = new Shoes_Type();
                            $shoes_type_result = $shoes_type->getAll_Shoes_Type();
                            while ($shoes_type_set = $shoes_type_result->fetch()):
                                ?>
                                <option value="<?php echo $shoes_type_set['id'] ?>"><?php echo $shoes_type_set['name'] ?>
                                </option>
                            <?php endwhile ?>
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
                            while ($brand_set = $brand_result->fetch()):
                                ?>
                                <option value="<?php echo $brand_set['id'] ?>"><?php echo $brand_set['name_brand'] ?>
                                </option>
                            <?php endwhile ?>
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


<!-- Đổ dữ liệu ra và lọc bằng filter -->
<?php
    $product = new Product();
    $goods_sold = new Goods_sold();
    $product_result = $product->getProduct_ByNamePriceDiscount()->fetchAll();
?>

<script>
    const products = <?php echo json_encode($product_result) ?>;
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
                        <li><a id="Product_id" data-product-id="${product.id}" class="btn btn-success text-white mt-2" href="index.php?action=details_product&id=${product.id}"><i class="far fa-eye"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body" style="min-height: 150px;">
                <a href="index.php?action=details_product&id=${product.id}" style="font-size: 14px!important;" class="fw-bold text-secondary text-decoration-none">${product.name}</a>
                <div class="d-flex justify-content-center pt-2">
                    ${formattedDiscount == 0 ? `<p class="text-center mx-5 fw-bold text-danger mb-0">${formattedPrice}đ</p>` : `
                    <p style="font-size: 15px!important;" class="text-center mx-1 fw-bolder text-decoration-line-through mb-0">${formattedPrice}đ</p>
                    <p style="font-size: 15px!important;" class="text-center text-danger mx-1 fw-bold mb-0">${formattedDiscount}đ</p>
                    `}
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <span class="badge text-bg-success">Chính hãng 100%</span>
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

