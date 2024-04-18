<div class="container mt-2">
   <div class="row">
      <div class="col-lg-12">
         <?php
         if (isset($_GET['act']) && $_GET['act'] == 'khoiphuc') {
            echo '<h3 class="text-center">KHÔI PHỤC KHÁCH HÀNG</h3>';
         } else {
            echo '<h3 class="text-center">THÔNG TIN KHÁCH HÀNG</h3>';
         }
         ?>
         <input id="search_User" type="text" placeholder="Tìm kiếm khách hàng" class="form-control">
         <table class="table ">
            <thead>
               <tr class="table-primary">
                  <th>STT</th>
                  <th>Họ</th>
                  <th>Tên</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th></th>
               </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
         </table>
      </div>
   </div>
</div>

<!-- Làm chức năng tìm kiếm và đổ dữ liệu -->
<?php
$user = new User();
if (isset($_GET['act']) && $_GET['act'] == 'khoiphuc') {
   $users = $user->getAllClear_User()->fetchAll();
} else {
   $users = $user->getAll_User()->fetchAll();
}
;
?>
<script>
   // Tìm kiếm khách hàng bằng email 
   $(document).on('input', '#search_User', function () {
      // Chuyển đổi về chữ thường và lấy giá trị
      let value_search = $(this).val().toLowerCase();

      // chuyển đổi từ dữ liệu PHP về JS
      const users = <?php echo json_encode($users) ?>;

      let filteredUsers = users;

      if (value_search.length > 0) {
         filteredUsers = users.filter(user => {
            return user.email.toLowerCase().includes(value_search);
         });
      }

      // Xóa tất cả các dòng trong tbody trước khi thêm dữ liệu mới
      $('#tbody').empty();

      var stt = 1;
      filteredUsers.forEach(user => {
         const row = `
         <tr class="table-warning">
            <td>${stt++}</td>
            <td>${user.firstname}</td>
            <td>${user.lastname}</td>
            <td>${user.email}</td>
            <td>${user.password}</td>
            <td>
               <?php if (isset($_GET['act']) && $_GET['act'] == 'khoiphuc') { ?>
                  <button id="restore_user" value="${user.id}" class="btn btn-primary">KHÔI PHỤC</button>
                  <button id="clear_user" value="${user.id}" class="btn btn-danger">XÓA</button>
               <?php } else { ?>
                  <a id="update_user" data-id="${user.id}" href="admin.php?action=user&act=update_user&id=${user.id}" class="btn btn-primary">SỬA</a>
                  <button id="delete_user" value="${user.id}" class="btn btn-danger">THÙNG RÁC</button>
               <?php } ?>
            </td>
         </tr>
         `;
         // append là một phương thức được sử dụng để thêm nội dung vào cuối phần tử được chọn
         $('#tbody').append(row);
      });
   });

   // Đảm bảo rằng dữ liệu được load lần đầu tiên khi trang được tải
   $(document).ready(function () {
      // Hàm trigger tự động kích hoạt input khi load trang
      $('#search_User').trigger('input');
   });
</script>
