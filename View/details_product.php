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
                    <img class="card-img img-fluid" data-src="<?php echo $product_result['img']?>" src="./View/assets/img/upload/<?php echo $product_result['img']?>" alt="Card image cap" id="product-detail">
                </div>
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <img style="width: 90px; height: 90px;" class="card-img img-fluid thumbnail cursor" src="./View/assets/img/upload/<?php echo $product_result['img']?>" alt="Card image cap" data-src="<?php echo $product_result['img']?>">
                        <img style="width: 90px; height: 90px;" class="card-img img-fluid thumbnail cursor" src="./View/assets/img/upload/<?php echo $product_result['img1']?>" alt="Card image cap" data-src="<?php echo $product_result['img1']?>">
                        <img style="width: 90px; height: 90px;" class="card-img img-fluid thumbnail cursor" src="./View/assets/img/upload/<?php echo $product_result['img2']?>" alt="Card image cap" data-src="<?php echo $product_result['img2']?>">
                        <img style="width: 90px; height: 90px;" class="card-img img-fluid thumbnail cursor" src="./View/assets/img/upload/<?php echo $product_result['img3']?>" alt="Card image cap" data-src="<?php echo $product_result['img3']?>">
                    </div>
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" id="idsp" value="<?php echo $product_result['id']?>">
                        <h1 id="name_product"><?php echo $product_result['tensp']?></h1>
                        <div class="d-flex">
                            <?php if($product_result['discount'] == 0){ ?>
                            <span data-value="<?php echo $product_result['discount']?>" id="discount" class="py-2 mx-3 text-danger" style="display: none;"></span>
                            <p data-value="<?php echo $product_result['price']?>" id="price" class="text-danger fw-bold"><?php echo number_format($product_result['price'])?>đ</p>
                            <?php }else {?>
                                <p data-value="<?php echo $product_result['price']?>" id="price" class="text-decoration-line-through"><?php echo number_format($product_result['price'])?>đ</p>
                                <h4 data-value="<?php echo $product_result['discount']?>" id="discount" class="py-2 mx-3 text-danger"><?php echo number_format($product_result['discount'])?>đ</h4>
                            <?php }?>
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
                                <p id="shoes_type" value="<?php echo $product_result['tenloai'];?>" class="text-info"><strong><?php echo strtoupper($product_result['tenloai'])?></strong></p>
                            </li>
                            <li class="list-inline-item">
                                <h6>Thương hiệu:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p id="brand" value="<?php echo $product_result['name_brand'];?>" class="text-info"><strong><?php echo strtoupper($product_result['name_brand'])?></strong></p>
                            </li>
                        </ul>

                        <h5 class="text-danger mb-4"><?php echo $product_result['descriptions']?></h5>

                            <input type="hidden" name="product-title" value="Activewear">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item">Size:</li>
                                        <?php 
                                            $size = new size();
                                            $size_result = $size->getSize_ByDetails($id);
                                            while($size_set = $size_result->fetch()):
                                        ?>
                                        <li class="list-inline-item"><span class="btn btn-success btn-size" data-size_id="<?php echo $size_set['size_id']?>"><?php echo $size_set['size']?></span></li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            Quantity
                                            <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                        <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                    </ul>
                                </div>
                                <div class="col-auto">
                                    <input type="hidden" id="product_id" value="<?php echo $id?>">
                                    <span id="repository" class="text-secondary fs-6"></span>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                </div>
                                <div class="col d-grid">
                                    <button id="addCart" class="btn btn-success btn-lg">Add To Cart</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .cursor { 
        cursor: pointer;
    }
</style>