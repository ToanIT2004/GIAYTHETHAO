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
                        <h4 id="name_product"><?php echo $product_result['tensp'] ?></h4>
                        <div class="d-flex">
                            <?php if ($product_result['discount'] == 0) { ?>
                                <span data-value="<?php echo $product_result['discount'] ?>" id="discount"
                                    class="py-2 mx-3 text-danger" style="display: none;"></span>
                                <p data-value="<?php echo $product_result['price'] ?>" id="price"
                                    class="text-danger fw-bold"><?php echo number_format($product_result['price']) ?>đ</p>
                            <?php } else { ?>
                                <p data-value="<?php echo $product_result['price'] ?>" id="price"
                                    class="text-decoration-line-through">
                                    <?php echo number_format($product_result['price']) ?>đ
                                </p>
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
                                <p id="shoes_type" value="<?php echo $product_result['tenloai']; ?>" class="text-secondary">
                                    <strong><?php echo strtoupper($product_result['tenloai']) ?></strong>
                                </p>
                            </li>
                            <li class="list-inline-item">
                                <h6>Thương hiệu:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p id="brand" value="<?php echo $product_result['name_brand']; ?>" class="text-secondary">
                                    <strong><?php echo strtoupper($product_result['name_brand']) ?></strong>
                                </p>
                            </li>
                        </ul>

                        <h5 class="fs-6 text-danger mb-4"><?php echo $product_result['descriptions'] ?></h5>

                        <input type="hidden" name="product-title" value="Activewear">
                        <div class="row">
                            <div class="col-auto">
                                <ul class="list-inline pb-3">
                                    <li class="list-inline-item fw-bolder" style="font-size: 16px!important;">Kích thước:</li>
                                    <?php
                                    $size = new size();
                                    $size_result = $size->getSize_ByDetails($id);
                                    while ($size_set = $size_result->fetch()):
                                        ?>
                                        <li class="list-inline-item"><span class="btn btn-success btn-size rounded-circle"
                                                data-size_id="<?php echo $size_set['size_id'] ?>"><?php echo $size_set['size'] ?></span>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <ul class="list-inline pb-3">
                                    <li style="font-size: 16px!important;" class="list-inline-item text-right fw-bolder">
                                        Số lượng
                                        <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                    </li>
                                    <li class="list-inline-item"><span class="btn btn-success rounded-circle" id="btn-minus">-</span>
                                    </li>
                                    <li class="list-inline-item"><span class="badge bg-secondary"
                                            id="var-value">1</span></li>
                                    <li class="list-inline-item"><span class="btn btn-success rounded-circle" id="btn-plus">+</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <input type="hidden" id="product_id" value="<?php echo $id ?>">
                                <span id="repository" class="text-secondary fs-6"></span>
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col d-grid">
                                <!-- Button trigger modal -->
                                <button id="buy_now" type="button" class="btn btn-success" data-bs-toggle="modal">Mua hàng ngay</button>
                                <input id="product_id" type="hidden" value="<?php echo $_GET['id'] ?>">
                                <!-- Modal -->
                                <div class="modal fade" id="ModalBuy_Now" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận mua hàng</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex mb-4">
                                                    <img style="width: 150px; height: 150px; border-radius: 30px;"
                                                        id="product_img" src="" alt="">
                                                    <div class="mx-3 mt-3">
                                                        <b id="product_name"></b> <br>
                                                        <div class="d-flex">
                                                            <span id="product_price"></span>
                                                            <span class="mx-1 ml-1">x</span>
                                                            <span id="product_quantity"></span>
                                                            <span class="mx-1 ml-1">=</span>
                                                            <span id="product_sum"></span>
                                                        </div>
                                                        <div class="d-flex">
                                                            <span>Size: </span>
                                                            <span class="mx-1" id="product_size"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" id="user_id"
                                                    value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0 ?>">
                                                <div class="form-group mb-3">
                                                    <label for="" class="mb-1">Họ tên khách hàng</label>
                                                    <input type="text"
                                                        value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : '' ?>"
                                                        id="fullname" class="form-control"
                                                        placeholder="Điền họ tên của bạn">
                                                    <small id="fullname_error" class="text-danger badge"></small>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="" class="mb-1">Số điện thoại</label>
                                                    <input type="text"
                                                        value="<?php echo isset($_SESSION['number_phone']) ? '0' . $_SESSION['number_phone'] : '' ?>"
                                                        id="number_phone" class="form-control"
                                                        placeholder="Điền số điện của bạn">
                                                    <small id="number_phone_error" class="text-danger badge"></small>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="" class="mb-1">Địa chỉ</label>
                                                    <input
                                                        value="<?php echo isset($_SESSION['address']) ? $_SESSION['address'] : '' ?>"
                                                        type="text" id="address" class="form-control"
                                                        placeholder="Điền địa chỉ của bạn">
                                                    <small id="address_error" class="text-danger badge"></small>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div class="form-group">
                                                        <label for="wards">Tỉnh/Thành</label>
                                                        <select style="width: 140px" class="form-control"
                                                            name="province" id="province">
                                                            <option value=>Chọn tỉnh/thành</option>
                                                            <?php
                                                            $Address = new Address_Order();
                                                            $Address_Result = $Address->getAll_Province();
                                                            while ($Address_set = $Address_Result->fetch()):
                                                                ?>
                                                                <option <?php echo (isset($_SESSION['province']) && $_SESSION['province'] == $Address_set['name']) ? 'selected' : '' ?>
                                                                    value="<?php echo $Address_set['province_id'] ?>">
                                                                    <?php echo $Address_set['name'] ?>
                                                                </option>
                                                            <?php endwhile ?>
                                                        </select>
                                                        <small id="province_error" class="text-danger badge"
                                                            style="font-size: 11px;"></small>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="wards">Quận/Huyện</label>
                                                        <select style="width: 140px" class="form-control"
                                                            name="district" id="district">
                                                            <option
                                                                value="<?php echo isset($_SESSION['district_id']) ? $_SESSION['district_id'] : '' ?>">
                                                                <?php echo (isset($_SESSION['district'])) ? $_SESSION['district'] : 'Chọn Quận/Huyện' ?>
                                                            </option>
                                                        </select>
                                                        <small id="district_error" class="text-danger badge"
                                                            style="font-size: 11px;"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="wards">Phường/Xã</label>
                                                        <select style="width: 140px" class="form-control" name="wards"
                                                            id="wards">
                                                            <option
                                                                value="<?php echo isset($_SESSION['wards_id']) ? $_SESSION['wards_id'] : '' ?>">
                                                                <?php echo (isset($_SESSION['wards'])) ? $_SESSION['wards'] : 'Chọn Phường/Xã' ?>
                                                            </option>
                                                        </select>
                                                        <small id="wards_error" class="text-danger badge"
                                                            style="font-size: 11px;"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="order_buy_now" type="button" class="btn btn-success">Xác
                                                    nhận</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col d-grid">
                                <button id="addCart" class="btn btn-success btn-lg">Thêm vào giỏ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h3 class="text-success mb-3">Đánh giá sản phẩm</h3>
        <!-- Lấy id theo đường dẫn -->
        <input id="comment_product_id" type="hidden" value="<?php echo $id ?>">
        <?php if (isset($_SESSION['user_id'])) { ?>
            <div class="row">
                <!-- Nếu đăng nhập mới có session -->
                <input id="comment_user_id" type="hidden" value="<?php echo $_SESSION['user_id'] ?>">
                <?php
                $comment = new Comment();
                $result = $comment->get_avatar($_SESSION['user_id'])
                    ?>
                <div class="col-lg-10">
                    <!-- Đánh giá sản phẩm -->
                    <div class="d-flex mt-1">
                        <img style="width: 50px; height: 50px; border-radius: 50px;"
                            src="./View/assets/img/avatar/<?php echo ($result) ? $result['avatar'] : 'avatar-trang-4.jpg' ?>"
                            alt="">
                        <textarea id="content_comment" placeholder="Nhập đánh giá sản phẩm của bạn"
                            class="form-control mx-3" style="border-radius: 20px;" rows="5" id=""></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="comment-upload pt-2" style="margin-left: 70px;">
                            <label for="comment_image" class="btn btn-white">
                                <i class="bi bi-image-fill"></i> Tải ảnh lên
                            </label>
                            <input type="file" id="comment_image" class="form-control d-none" accept="image/*">
                            <small class="preview_comment_error"></small>
                        </div>
                        <button id="send_comment" style="border-radius: 10px;margin-right: 15px" class="mt-3 mb-3 btn btn-outline-dark">Gửi</button>
                    </div>
                    <img class="mb-3 d-none" style="width: 200px; height: 200px; margin-left: 100px;" id="preview_comment_image" src="" alt="">

                </div>
            </div>
        <?php } ?>
        <!-- Table comment -->
        <div class="row table_comment"></div>

    </div>
</section>


<style>
    .cursor {
        cursor: pointer;
    }
</style>