<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <?php
            $product = new Product();
            $id = isset($_GET['id']) ? $_GET['id'] : null; // Khởi tạo biến $id
            $product_result = $product->getOne_DetailProduct($id);
            ?>
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" data-src="<?php echo $product_result['img'] ?>"
                        src="./View/assets/img/upload/<?php echo $product_result['img'] ?>" alt="Card image cap"
                        id="product-detail">
                </div>
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <img style="width: 90px; height: 90px;" class="card-img img-fluid thumbnail cursor"
                            src="./View/assets/img/upload/<?php echo $product_result['img'] ?>" alt="Card image cap"
                            data-src="<?php echo $product_result['img'] ?>">
                        <img style="width: 90px; height: 90px;" class="card-img img-fluid thumbnail cursor"
                            src="./View/assets/img/upload/<?php echo $product_result['img1'] ?>" alt="Card image cap"
                            data-src="<?php echo $product_result['img1'] ?>">
                        <img style="width: 90px; height: 90px;" class="card-img img-fluid thumbnail cursor"
                            src="./View/assets/img/upload/<?php echo $product_result['img2'] ?>" alt="Card image cap"
                            data-src="<?php echo $product_result['img2'] ?>">
                        <img style="width: 90px; height: 90px;" class="card-img img-fluid thumbnail cursor"
                            src="./View/assets/img/upload/<?php echo $product_result['img3'] ?>" alt="Card image cap"
                            data-src="<?php echo $product_result['img3'] ?>">
                    </div>
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" id="idsp" value="<?php echo $product_result['id'] ?>">
                        <h1 id="name_product"><?php echo $product_result['tensp'] ?></h1>
                        <div class="d-flex">
                            <?php if ($product_result['discount'] == 0) { ?>
                                <span data-value="<?php echo $product_result['discount'] ?>" id="discount"
                                    class="py-2 mx-3 text-danger" style="display: none;"></span>
                                <p data-value="<?php echo $product_result['price'] ?>" id="price"
                                    class="text-danger fw-bold"><?php echo number_format($product_result['price']) ?>đ</p>
                            <?php } else { ?>
                                <p data-value="<?php echo $product_result['price'] ?>" id="price"
                                    class="text-decoration-line-through">
                                    <?php echo number_format($product_result['price']) ?>đ</p>
                                <h4 data-value="<?php echo $product_result['discount'] ?>" id="discount"
                                    class="py-2 mx-3 text-danger"><?php echo number_format($product_result['discount']) ?>đ
                                </h4>
                            <?php } ?>
                        </div>
                        <p class="py-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-secondary"></i>
                        </p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Loại giày:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p id="shoes_type" value="<?php echo $product_result['tenloai']; ?>" class="text-info">
                                    <strong><?php echo strtoupper($product_result['tenloai']) ?></strong></p>
                            </li>
                            <li class="list-inline-item">
                                <h6>Thương hiệu:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p id="brand" value="<?php echo $product_result['name_brand']; ?>" class="text-info">
                                    <strong><?php echo strtoupper($product_result['name_brand']) ?></strong></p>
                            </li>
                        </ul>

                        <h5 class="text-danger mb-4"><?php echo $product_result['descriptions'] ?></h5>

                        <input type="hidden" name="product-title" value="Activewear">
                        <div class="row">
                            <div class="col-auto">
                                <ul class="list-inline pb-3">
                                    <li class="list-inline-item">Size:</li>
                                    <?php
                                    $size = new size();
                                    $size_result = $size->getSize_ByDetails($id);
                                    while ($size_set = $size_result->fetch()):
                                        ?>
                                        <li class="list-inline-item"><span class="btn btn-success btn-size"
                                                data-size_id="<?php echo $size_set['size_id'] ?>"><?php echo $size_set['size'] ?></span>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <ul class="list-inline pb-3">
                                    <li class="list-inline-item text-right">
                                        Quantity
                                        <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                    </li>
                                    <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span>
                                    </li>
                                    <li class="list-inline-item"><span class="badge bg-secondary"
                                            id="var-value">1</span></li>
                                    <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <input type="hidden" id="product_id" value="<?php echo $id ?>">
                                <span id="repository" class="text-secondary fs-6"></span>
                            </div>
                        </div>
                        <div class="row pb-3">
                            <!-- <div class="col d-grid">
                                <button type="button" id="buy" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Mua Ngay</button>
                            </div> -->
                            <div class="col d-grid">
                                <button id="addCart" class="btn btn-success btn-lg">Thêm vào giỏ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4 text-success" id="exampleModalLabel">Xác nhận đơn hàng</h1> <br>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="user_id"
                    value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0 ?>">
                <div class="form-group mb-3">
                    <label for="" class="mb-1">Họ tên khách hàng</label>
                    <input type="text" value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : '' ?>"
                        id="fullname" class="form-control" placeholder="Điền họ tên của bạn">
                    <small id="fullname_error" class="text-danger"></small>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="mb-1">Số điện thoại</label>
                    <input type="text" id="number_phone" class="form-control" placeholder="Điền số điện của bạn">
                    <small id="numberphone_error" class="text-danger"></small>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="mb-1">Địa chỉ</label>
                    <input type="text" id="address" class="form-control" placeholder="Điền địa chỉ của bạn">
                </div>

                <div class="d-flex justify-content-between">
                    <div class="form-group">
                        <label for="wards">Tỉnh/Thành</label>
                        <select style="width: 140px" class="form-control" name="province" id="province">
                            <option value=>Chọn tỉnh/thành</option>
                            <?php
                            $Address = new Address_Order();
                            $Address_Result = $Address->getAll_Province();
                            while ($Address_set = $Address_Result->fetch()):
                                ?>
                                <option value="<?php echo $Address_set['province_id'] ?>"><?php echo $Address_set['name'] ?>
                                </option>
                            <?php endwhile ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="wards">Quận/Huyện</label>
                        <select style="width: 140px" class="form-control" name="district" id="district">
                            <option value=>Chọn quận/huyện</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="wards">Phường/Xã</label>
                        <select style="width: 140px" class="form-control" name="wards" id="wards">
                            <option value=>Chọn phường/xã</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <span class="h3 fs-4">Tổng tiền</span>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" id="buy_order" class="btn btn-primary">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<style>
    .cursor {
        cursor: pointer;
    }
</style>