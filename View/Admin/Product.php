<div class="mt-5 col-md-4 col-md-offset-4">
  <h3><b>DANH SÁCH SẢN PHẨM</b></h3>
</div>

<div class="row col-5">
  <label for="">Loại giày</label>
  <select id="shoes-type" class="form-select form-select-lg mb-3" aria-label="Large select example">
    <?php
    $shoes_type = new Shoes_Type();
    $kq = $shoes_type->getAll_Shoes_Type();
    while ($set = $kq->fetch()):
      ?>
      <option value="<?php echo $set['id'] ?>"><?php echo $set['name'] ?></option>
    <?php endwhile ?>
  </select>
</div>

<div class="row col-5 ml-4">
  <label for="">Thương hiệu</label>
  <select id="brand" class="form-select form-select-lg mb-3" aria-label="Large select example">
    <?php
    $brand = new Brand();
    $kq = $brand->getAll_Brand();
    while ($set = $kq->fetch()):
      ?>
      <option value="<?php echo $set['id'] ?>"><?php echo $set['name_brand'] ?></option>
    <?php endwhile ?>
  </select>
</div>

<div class="row">
  <table id="product-table" class="table">
      <thead>
        <tr class="table-primary">
          <th>Mã sản phẩm</th>
          <th>Tên sản phẩm</th>
          <th>Mô tả</th>
          <th>Hình ảnh</th>
          <th></th>
        </tr>
      </thead>
      <tbody></tbody>
  </table>
</div>

<!-- Modal chỉnh sửa -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<?php
$Product = new Product();
$sanpham = $Product->getAll_Product()->fetchAll();
?>
<script>
  const products = <?php echo json_encode($sanpham); ?>;
  function filerProduct() {
    // Lấy value 
    const shoes_type = document.getElementById('shoes-type').value;
    const brand = document.getElementById('brand').value;

    const filteredProducts = products.filter(product => {
      return (shoes_type == product.shoes_type_id && brand == product.brand_id)
    })

    // Cập nhật nội dung của bảng
    const tableBody = document.getElementById('product-table').querySelector('tbody');
    tableBody.innerHTML = '';
    filteredProducts.forEach(product => {
      const row = `<tr>
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.descriptions}</td>
                    <td><img style="width: 100px; height: 80px" src="View/assets/img/upload/${product.img}" alt=""></td>

                    <td class="text-center">
                      <a href="admin.php?action=product&act=update_Product&id=${product.id}" class="btn btn-warning mx-1">Chỉnh sửa</a> 
                      <a class="btn btn-primary mx-1" href="admin.php?action=product&act=product_details&id=${product.id}">Chi tiết</a> 
                      <a href="#" class="btn btn-danger mx-1" onclick="confirmDelete(${product.id})">Xóa</a>
                    </td>
                  </tr>`;
      tableBody.innerHTML += row;
    });
    }

  // Khi click option thì nó sẽ load lại 
  document.getElementById('shoes-type').addEventListener('change', filerProduct);
  document.getElementById('brand').addEventListener('change', filerProduct);

  filerProduct();

  // Hàm xác nhận có xóa sản phẩm hay không ? bởi vì khi xóa sẽ xóa luôn chi tiết
  function confirmDelete(productId) {
        // Hiển thị hộp thoại xác nhận
        if (confirm('Khi xóa sản phẩm nó sẽ xóa luôn tất cả chi tiết, Bạn có muốn xóa không?')) {
            // Nếu người dùng đồng ý, chuyển hướng đến trang xóa sản phẩm
            window.location.href = `admin.php?action=product&act=delete_product&id=${productId}`;
        } else {
            // Nếu người dùng hủy bỏ, không làm gì cả
            return false;
        }
    }
</script>